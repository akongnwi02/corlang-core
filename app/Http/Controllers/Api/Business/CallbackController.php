<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/12/20
 * Time: 10:45 PM
 */

namespace App\Http\Controllers\Api\Business;

use App\Exceptions\Api\ServerErrorException;
use App\Http\Controllers\Controller;
use App\Jobs\Business\Purchase\CompletePurchaseJob;
use App\Models\Transaction\Transaction;
use App\Repositories\Backend\Movement\MovementRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    /**
     * @param Request $request
     * @param Transaction $transaction
     * @param MovementRepository $movementRepository
     * @param PaymentMethodRepository $paymentMethodRepository
     * @return \Illuminate\Http\JsonResponse
     * @throws ServerErrorException
     */
    public function callback(Request $request, Transaction $transaction, MovementRepository $movementRepository, PaymentMethodRepository $paymentMethodRepository)
    {
        \Log::info('New callback request received', [
            'ip'      => $request->ip(),
            'payload' => $request->input()
        ]);
        
        $transactionInLocalDb = [
            'transaction.status'                => $transaction->status,
            'transaction.uuid'                  => $transaction->uuid,
            'transaction.code'                  => $transaction->code,
            'transaction.service_code'          => $transaction->service_code,
            'transaction.movement_code'         => $transaction->movement_code,
            'transaction.paymentaccount'        => $transaction->paymentaccount,
            'transaction.created_at'            => $transaction->created_at->toDatetimeString(),
            'transaction.destination'           => $transaction->destination,
            'transaction.total_customer_amount' => $transaction->total_customer_amount,
        ];
        
        \Log::debug('Transaction exists in local database', $transactionInLocalDb);
    
        if (in_array($transaction->status, [
            config('business.transaction.status.failed'),
            config('business.transaction.status.success'),
        ])) {
            \Log::emergency('Transaction in final status received a status update',[
                'status received'                   => $request->input('status'),
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
            throw new ServerErrorException(BusinessErrorCodes::TRANSACTION_IN_FINAL_STATUS, "Transaction $transaction->code in final state received a status update");
        };
        
        $transaction->status         = $request->input('status');
        $transaction->asset          = $request->input('asset');
        $transaction->message        = $request->input('message');
        $transaction->error_code     = $request->input('error_code');
        $transaction->to_be_verified = $request->input('to_be_verified');
        $transaction->completed_at   = now();
        $transaction->save();
    
        if ($transaction->status != config('business.transaction.status.success')) {
            \Log::warning("{$this->getClassName()}: Transaction is not successful. Reversing movements...", [
                'transaction.status' => $transaction->status,
                'transaction.code'   => $transaction->code,
                'movement.code'      => $transaction->movement_code
            ]);
        
            $movementRepository->reverseMovements($transaction->movement_code);
        }
    
        if ($transaction->status == config('business.transaction.status.success')) {
            if ($transaction->is_account_topup) {
                if ($paymentMethodRepository->confirmTopupMethod($transaction->user, $transaction->service->payment_method)) {
                    \Log::info("{$this->getClassName()}: The account top up method has been successfully confirmed for this topup transaction");
                } else {
                    \Log::error("{$this->getClassName()}: There was an error confirming the top up account method for this top up transaction");
                }
            }
        }

    
        \Log::info("{$this->getClassName()}: Completing movement for this transaction. To be counted in the balance for withdrawals");
        
        $movementRepository->completeMovements($transaction->movement_code);
        
        \Log::info('Inserting transaction to COMPLETE queue');
        
        dispatch(new CompletePurchaseJob($transaction))->onQueue(config('business.transaction.queue.purchase.complete'));
     
        return response()->json([
            'status' => 'OK'
        ], 200);
    }
}
