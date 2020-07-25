<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/13/20
 * Time: 10:58 PM
 */

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Transaction;

use App\Services\Clients\Merchant\V1\MerchantNotificationClient;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    /**
     * @param Request $request
     * @param Transaction $transaction
     * @param MerchantNotificationClient $notificationClient
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\Api\ServerErrorException
     */
    public function callback(
        Request $request,
        Transaction $transaction,
        MerchantNotificationClient $notificationClient
    )
    {
        \Log::info('New merchant callback request received', [
            'ip'      => $request->ip(),
            'payload' => $request->input()
        ]);
    
        $this->handleTransactionCallback($transaction, $request);
    
        \Log::info('Sending notification request to merchant with final status');
        
        $transaction->refresh();
    
        $order = $transaction->merchant_order;
    
        if (! $order) {
            \Log::emergency('Cannot find merchant order for the payment transaction', [
                'transaction.status'                => $transaction->status,
                'transaction.uuid'                  => $transaction->uuid,
                'transaction.code'                  => $transaction->code,
                'transaction.service_code'          => $transaction->service_code,
                'transaction.movement_code'         => $transaction->movement_code,
                'transaction.paymentaccount'        => $transaction->paymentaccount,
                'transaction.created_at'            => $transaction->created_at->toDatetimeString(),
                'transaction.destination'           => $transaction->destination,
                'transaction.total_customer_amount' => $transaction->total_customer_amount,
            ]);
        } else {
            $order->status = $transaction->status;
            $order->completed_at = $transaction->completed_at;
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
    
            $notificationClient->send($order);
        }
    
        return $this->callbackSuccessResponse();
    }
}
