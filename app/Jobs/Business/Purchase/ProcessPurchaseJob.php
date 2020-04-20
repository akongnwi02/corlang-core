<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/2/20
 * Time: 9:26 PM
 */

namespace App\Jobs\Business\Purchase;

use App\Exceptions\Api\BadRequestException;
use App\Jobs\Job;
use App\Models\Transaction\Transaction;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Services\Business\Validators\CategoryProvider;
use App\Services\Constants\BusinessErrorCodes;
use Log;

class ProcessPurchaseJob extends Job
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
     * Number of retries
     * @var int
     */
    public $tries = 1;
    
    /**
     * Timeout
     * @var int
     */
    public $timeout = 300;
    
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
    
    /**
     * @param ServiceRepository $serviceRepository
     * @throws \App\Exceptions\Api\ServerErrorException
     */
    public function handle(ServiceRepository $serviceRepository)
    {
        
        $service        = $serviceRepository->findByCode($this->transaction->service_code);
        $categoryClient = $this->category($service->category);
        
        Log::info("{$this->getJobName()}: Processing new purchase job", [
            'status'        => $this->transaction->status,
            'code'          => $this->transaction->code,
            'destination'   => $this->transaction->destination,
            'category_name' => $service->category->name,
            'service_name'  => $service->name,
        ]);
        $this->transaction->status = config('business.transaction.status.processing');
        $this->transaction->save();
        
        try {
            
            $categoryClient->confirm($this->transaction);
    
        } catch (BadRequestException $exception) {
            $this->transaction->status     = config('business.transaction.status.failed');
            $this->transaction->user_status= config('business.transaction.status.failed');
            $this->transaction->error      = $exception->getMessage();
            $this->transaction->message    = 'Transaction failed due to client error';
            $this->transaction->error_code = $exception->error_code();
            $this->transaction->save();
            
            Log::error("{$this->getJobName()}: Transaction failed due to client error. Inserted into COMPLETE queue", [
                'status'           => $this->transaction->status,
                'transaction.code' => $this->transaction->code,
                'destination'      => $this->transaction->destination,
                'message'          => $this->transaction->message,
                'exception'        => $exception,
            ]);
            
            dispatch(new CompletePurchaseJob($this->transaction))->onQueue(config('business.transaction.queue.purchase.complete'));
        }
    }
    
    public function failed(\Exception $exception)
    {
        $this->transaction->status  = config('business.transaction.status.errored');
        $this->transaction->message = 'Failed unexpectedly while sending to micro service';
        $this->transaction->error_code = BusinessErrorCodes::GENERAL_CODE;
        $this->transaction->error   = $exception->getMessage();
        $this->transaction->save();
        Log::emergency("{$this->getJobName()}: Transaction failed unexpectedly while sending to micro service, Inserting to VERIFICATION queue", [
            'transaction.status'      => $this->transaction->status,
            'transaction.uuid'        => $this->transaction->uuid,
            'transaction.destination' => $this->transaction->destination,
            'transaction.amount'      => $this->transaction->amount,
            'transaction.message'     => $this->transaction->message,
            'transaction.error'       => $this->transaction->error,
            'transaction.error_code'  => $this->transaction->error_code,
            'exception'               => $exception,
        ]);
        
        dispatch(new VerifyPurchaseJob($this->transaction))->onQueue(config('business.transaction.queue.purchase.verify'));
    }
    
}
