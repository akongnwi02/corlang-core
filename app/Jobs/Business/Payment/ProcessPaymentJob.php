<?php

namespace App\Jobs\Payment;

use App\Jobs\Job;
use App\Models\Transaction\Transaction;

class ProcessPaymentJob extends Job
{
    public $transaction;
    /**
     * Create a new job instance.
     *
     * @param Transaction $transaction
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
