<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/2/20
 * Time: 9:34 PM
 */

namespace App\Jobs\Business\Purchase;

use App\Events\Api\Merchant\OrderPaymentCompleted;
use App\Jobs\Job;
use App\Models\Transaction\Transaction;
use App\Repositories\Backend\Movement\MovementRepository;
use App\Repositories\Backend\System\CurrencyRepository;
use App\Services\Business\Validators\CategoryProvider;

class VerifyPurchaseJob extends Job
{
    use CategoryProvider;
    
    /**
     * @var Transaction
     */
    public $transaction;
    
    /**
     * Avoid processing deleted jobs
     */
    public $deleteWhenMissingModels = true;
    
    /**
     * Timeout
     * @var int
     */
    public $timeout = 150;
    
    /**
     * Number of retries
     * @var int
     */
    public $tries = 5;
    
    /**
     * Create a new job instance.
     * @param $transaction
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
    
    /**
     * Handler
     */
    public function handle()
    {
        \Log::info("{$this->getJobName()}: Processing new transaction status verification job", [
            'status'       => $this->transaction->status,
            'code'         => $this->transaction->code,
            'destination'  => $this->transaction->destination,
            'service_code' => $this->transaction->service_code,
            'uuid'         => $this->transaction->uuid,
        ]);
    
        if (in_array($this->transaction->status, [
            config('business.transaction.status.failed'),
            config('business.transaction.status.success'),
        ])) {
            \Log::warning("{$this->getJobName()}: Transaction is already in final state. No further verification is required", [
                'transaction.status'      => $this->transaction->status,
                'transaction.code'        => $this->transaction->code,
                'transaction.uuid'        => $this->transaction->uuid,
                'transaction.destination' => $this->transaction->destination,
                'transaction.amount'      => $this->transaction->amount,
                'transaction.message'     => $this->transaction->message,
                'transaction.error'       => $this->transaction->error,
                'transaction.error_code'  => $this->transaction->error_code,
            ]);
            $this->delete();
            
            return;
        }
        
        $this->transaction->status = config('business.transaction.status.verification');
        $this->transaction->save();
        
        try {
            
            $this->category($this->transaction->category)->status($this->transaction);
            $this->transaction->status  = config('business.transaction.status.processing');
            $this->transaction->message = 'Verified and discovered transaction in micro service';
            $this->transaction->save();
    
            \Log::warning("{$this->getJobName()}: Transaction exists in micro service system. Waiting for callback...", [
                'status'       => $this->transaction->status,
                'code'         => $this->transaction->code,
                'destination'  => $this->transaction->destination,
                'uuid'         => $this->transaction->uuid,
                'service_code' => $this->transaction->service_code,
            ]);
            
        } catch (\Exception $exception) {
            \Log::info("{$this->getJobName()}: Status verification attempt failed", [
                'error message'  => $exception->getMessage(),
                'status'         => $this->transaction->status,
                'transaction.id' => $this->transaction->id,
                'destination'    => $this->transaction->destination,
                'callback_url'   => $this->transaction->callback_url,
                'attempts'       => $this->attempts(),
            ]);
            
            /*
             * Delay job before attempting the next status verification
             */
            $this->release($this->attempts() * 2);
        }
    }
    
    public function failed(\Exception $exception = null)
    {
        $movementRepository = new MovementRepository(new CurrencyRepository());
        
        \Log::warning("{$this->getJobName()}: Transaction failed during status check with micro service. Reversing movements...", [
            'transaction.status' => $this->transaction->status,
            'transaction.code'   => $this->transaction->code,
            'movement.code'      => $this->transaction->movement_code
        ]);
        
        $movementRepository->reverseMovements($this->transaction->movement_code);
    
        \Log::info("{$this->getJobName()}: Completing movement for this transaction. To be counted in the balance for withdrawals");
    
        $movementRepository->completeMovements($this->transaction->movement_code);
        
        $this->transaction->status  = config('business.transaction.status.failed');
        $this->transaction->message = 'Transaction failed unexpectedly while verifying status';
        $this->transaction->to_be_verified = true;
        $this->transaction->completed_at   = now();
        $this->transaction->save();
        
        \Log::emergency("{$this->getJobName()}: Transaction failed unexpectedly during status check. Inserted into COMPLETE queue", [
            'transaction.status'      => $this->transaction->status,
            'transaction.code'        => $this->transaction->code,
            'transaction.uuid'        => $this->transaction->uuid,
            'transaction.destination' => $this->transaction->destination,
            'transaction.amount'      => $this->transaction->amount,
            'transaction.message'     => $this->transaction->message,
            'transaction.error'       => $this->transaction->error,
            'transaction.error_code'  => $this->transaction->error_code,
            'exception'               => $exception,
        ]);
        
        // set any merchant order to failed
        if ($this->transaction->merchant_order) {
            \Log::info("{$this->getJobName()}: Updating the merchant order status");
            $order = $this->transaction->merchant_order;
            
            $order->status = $this->transaction->status;
            $order->completed_at = $this->transaction->completed_at;
            $order->save();
    
            \Log::info('Order updated successfully', [
                'uuid'            => $order->uuid,
                'external_id'     => $order->external_id,
                'status'          => $order->status,
                'error_code'      => $order->transaction ? $order->transaction->error_code : null,
                'partner_ref'     => $order->transaction ? $order->transaction->merchant_id : null,
                'payment_ref'     => $order->code,
                'payment_method'  => $order->paymentmethod,
                'payment_account' => $order->paymentaccount,
            ]);
    
            event(new OrderPaymentCompleted($order));
        }
        
        /*
         * Transaction Status cannot be determined after several retries. Send to callback queue
         */
        dispatch(new CompletePurchaseJob($this->transaction))->onQueue(config('business.transaction.queue.purchase.complete'));
    }
    
    public function getJobName()
    {
        return class_basename($this);
    }
}
