<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/25/20
 * Time: 12:36 PM
 */

namespace App\Jobs\Merchant\Order;


use App\Jobs\Business\Purchase\ProcessPurchaseJob;
use App\Jobs\Job;

class ProcessOrderJob extends Job
{
    public $order;
    
    public function __construct($order)
    {
        $this->order = $order;
    }
    
    public function handle()
    {
        $order = $this->order;
        
        \Log::info("{$this->getJobName()}: Processing new order job", [
            'uuid'            => $order->uuid,
            'external_id'     => $order->external_id,
            'status'          => $order->status,
            'error_code'      => $order->transaction ? $order->transaction->error_code : null,
            'partner_ref'     => $order->transaction ? $order->transaction->merchant_id : null,
            'payment_ref'     => $order->code,
            'payment_method'  => $order->paymentmethod,
            'payment_account' => $order->paymentaccount,
        ]);
        
        $config['callback_url'] = config('app.merchant.callback_url');
    
        dispatch(new ProcessPurchaseJob($this->order->transaction, $config))->onQueue(config('business.transaction.queue.purchase.process'));
    }
    
    public function getJobName()
    {
        return class_basename($this);
    }
}
