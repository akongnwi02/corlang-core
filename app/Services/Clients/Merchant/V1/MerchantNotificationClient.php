<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/25/20
 * Time: 12:40 PM
 */

namespace App\Services\Clients\Merchant\V1;

use App\Models\Merchant\MerchantOrder;
use GuzzleHttp\Client;
use Log;

class MerchantNotificationClient
{
    /**
     * @param MerchantOrder $order
     */
    public function send(MerchantOrder $order)
    {
        $json = $this->getNotificationData($order);
            
            Log::debug("{$this->getClientName()}: Sending merchant notification request", [
                'url'               => $order->notification_url,
                'order.uuid'        => $order->uuid,
                'order.external_id' => $order->external_id,
                'order.status'      => $order->status,
                'json'              => $json,
            ]);
            
        $httpClient = $this->getHttpClient();
        
        try {
            $response = $httpClient->request('PUT', $order->notification_url, [
                'json' => $json
            ]);
            
            $content = $response->getBody()->getContents();
    
            Log::debug("{$this->getClientName()}: Notification request sent successfully to client", [
                'order.status'         => $order->status,
                'order.uuid'           => $order->uuid,
                'order.external_id'    => $order->external_id,
                'status code'          => $response->getStatusCode(),
                'response from target' => $content,
            ]);
            
        } catch (\Exception $exception) {
            Log::error('Error sending notification request to merchant: ' . $exception->getMessage(), [
                'url'               => $order->notification_url,
                'order.uuid'        => $order->uuid,
                'order.external_id' => $order->external_id,
                'order.status'      => $order->status,
                'json'              => $json,
            ]);
        }
    }
    
    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client([
            'timeout'         => 120,
            'connect_timeout' => 120,
            'allow_redirects' => true,
        ]);
    }
    
    public function getClientName()
    {
        return class_basename($this);
    }
    
    public function getNotificationData($order)
    {
        return [
            'uuid'            => $order->uuid,
            'external_id'     => $order->external_id,
            'status'          => $order->status,
            'error_code'      => $order->transaction ? $order->transaction->error_code : null,
            'partner_ref'     => $order->transaction ? $order->transaction->merchant_id : null,
            'payment_ref'     => $order->code,
            'payment_method'  => $order->paymentmethod,
            'payment_account' => $order->paymentaccount,
        ];
    }
}
