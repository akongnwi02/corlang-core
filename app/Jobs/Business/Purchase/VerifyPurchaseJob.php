<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/2/20
 * Time: 9:34 PM
 */

namespace App\Jobs\Business\Purchase;

use App\Jobs\Job;
use App\Models\Transaction\Transaction;
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
        \Log::info("{$this->getJobName()}: Processing new status verification job", [
            'status'       => $this->transaction->status,
            'code'         => $this->transaction->code,
            'destination'  => $this->transaction->destination,
            'service_code' => $this->transaction->service_code,
            'uuid'         => $this->transaction->uuid,
        ]);
        
        $this->transaction->status = config('business.transaction.status.verification');
        $this->transaction->save();
        
        try {
            
            $this->category($this->transaction->category)->status($this->transaction);
            \Log::info("{$this->getJobName()}: Transaction exists in micro service system. Waiting for callback...", [
                'status'       => $this->transaction->status,
                'code'         => $this->transaction->code,
                'destination'  => $this->transaction->destination,
                'uuid'         => $this->transaction->uuid,
                'service_code' => $this->transaction->service_code,
            ]);
            $this->transaction->status  = config('business.transaction.status.processing');
            $this->transaction->message = 'Verified and discovered transaction in micro service';
            $this->transaction->save();
            
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
        $this->transaction->status  = config('business.transaction.status.failed');
        $this->transaction->message = 'Transaction failed unexpectedly while verifying status';
        $this->transaction->save();
        \Log::emergency("{$this->getJobName()}: Transaction failed unexpectedly during status check. Inserted into COMPLETE queue", [
            'transaction.code'        => $this->transaction->code,
            'transaction.uuid'        => $this->transaction->uuid,
            'transaction.destination' => $this->transaction->destination,
            'transaction.amount'      => $this->transaction->amount,
            'transaction.message'     => $this->transaction->message,
            'transaction.error'       => $this->transaction->error,
            'transaction.error_code'  => $this->transaction->error_code,
            'exception'               => $exception,
        ]);
        
        /*
         * Transaction Status cannot be determined after several retries. Send to callback queue
         */
        dispatch(new CompletePurchaseJob($this->transaction))->onQueue(config('business.transaction.queue.purchase.complete'));
    }
}
