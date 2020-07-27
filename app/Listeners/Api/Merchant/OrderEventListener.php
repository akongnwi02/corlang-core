<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/26/20
 * Time: 5:19 PM
 */

namespace App\Listeners\Api\Merchant;

use App\Services\Clients\Merchant\V1\MerchantNotificationClient;

class OrderEventListener
{
    public $client;
    
    public function __construct(MerchantNotificationClient $client)
    {
        $this->client = $client;
    }
    
    public function onUpdated($event)
    {
        $order = $event->order;
        
        \Log::info('Order Updated', [
            'uuid'            => $order->uuid,
            'external_id'     => $order->external_id,
            'status'          => $order->status,
            'error_code'      => $order->transaction ? $order->transaction->error_code : null,
            'partner_ref'     => $order->transaction ? $order->transaction->asset : null,
            'payment_ref'     => $order->code,
            'payment_method'  => $order->paymentmethod,
            'payment_account' => $order->paymentaccount,
        ]);
    
        if ($order->notification_url) {
            $this->client->send($order);
        } else {
            \Log::warning('Notification was NOT sent to merchant. Notification URL is empty');
        }
    }
    
    public function onPaymentInitiated($event)
    {
        $order = $event->order;
        
        \Log::info('Order Payment Initiated', [
            'uuid'            => $order->uuid,
            'external_id'     => $order->external_id,
            'status'          => $order->status,
            'error_code'      => $order->transaction ? $order->transaction->error_code : null,
            'partner_ref'     => $order->transaction ? $order->transaction->asset : null,
            'payment_ref'     => $order->code,
            'payment_method'  => $order->paymentmethod,
            'payment_account' => $order->paymentaccount,
        ]);
    
        if ($order->notification_url) {
            $this->client->send($order);
        } else {
            \Log::warning('Notification was NOT sent to merchant. Notification URL is empty');
        }
    }
    
    public function onPaymentCompleted($event)
    {
        $order = $event->order;
        
        \Log::info('Order Payment Completed', [
            'uuid'            => $order->uuid,
            'external_id'     => $order->external_id,
            'status'          => $order->status,
            'error_code'      => $order->transaction ? $order->transaction->error_code : null,
            'partner_ref'     => $order->transaction ? $order->transaction->asset : null,
            'payment_ref'     => $order->code,
            'payment_method'  => $order->paymentmethod,
            'payment_account' => $order->paymentaccount,
        ]);
    
        if ($order->notification_url) {
            $this->client->send($order);
        } else {
            \Log::warning('Notification was NOT sent to merchant. Notification URL is empty');
        }
    }
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Api\Merchant\OrderUpdated::class,
            'App\Listeners\Api\Merchant\OrderEventListener@onUpdated'
        );
        $events->listen(
            \App\Events\Api\Merchant\OrderPaymentInitiated::class,
            'App\Listeners\Api\Merchant\OrderEventListener@onPaymentInitiated'
        );
        $events->listen(
            \App\Events\Api\Merchant\OrderPaymentCompleted::class,
            'App\Listeners\Api\Merchant\OrderEventListener@onPaymentCompleted'
        );
    }
}
