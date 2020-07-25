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
use App\Services\Clients\Merchant\V1\MerchantNotificationClient;

class ProcessOrderJob extends Job
{
    public $order;
    
    public function __construct($order)
    {
        $this->order = $order;
    }
    
    public function handle(MerchantNotificationClient $notificationClient)
    {
        $config['callback_url'] = config('app.merchant.callback_url');
        
        $notificationClient->send($this->order);
    
        dispatch(new ProcessPurchaseJob($this->order->transaction, $config));
    }
    
    public function getJobName()
    {
        return class_basename($this);
    }
}
