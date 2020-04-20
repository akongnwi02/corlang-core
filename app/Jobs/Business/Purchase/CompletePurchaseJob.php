<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/2/20
 * Time: 9:35 PM
 */

namespace App\Jobs\Business\Purchase;

use App\Events\Api\Business\TransactionComplete;
use App\Jobs\Job;
use App\Models\Transaction\Transaction;

class CompletePurchaseJob extends Job
{
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
    public $tries = 5;
    
    /**
     * Timeout
     * @var int
     */
    public $timeout = 120;
    
    /**
     * Create a new job instance.
     *
     * @param Transaction $transaction
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
    
    public function handle()
    {
        \Log::info("{$this->getJobName()}: Transaction is terminated. Broadcasting new event...", [
            'transaction.status'                => $this->transaction->status,
            'transaction.asset'                 => $this->transaction->asset,
            'transaction.code'                  => $this->transaction->code,
            'transaction.uuid'                  => $this->transaction->uuid,
            'transaction.destination'           => $this->transaction->destination,
            'transaction.amount'                => $this->transaction->amount,
            'transaction.message'               => $this->transaction->message,
            'transaction.error'                 => $this->transaction->error,
            'transaction.error_code'            => $this->transaction->error_code,
            'transaction.external_id'           => $this->transaction->external_id,
            'transaction.verification_attempts' => $this->transaction->callback_attempts,
            'transaction.service_code'          => $this->transaction->service_code,
        ]);
        
        event(new TransactionComplete($this->transaction));
    }
}
