<?php

namespace App\Http\Controllers;

use App\Exceptions\Api\ServerErrorException;
use App\Models\Transaction\Transaction;
use App\Repositories\Backend\Movement\MovementRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $movementRepository;
    public $paymentMethodRepository;
    
    public function __construct(
        MovementRepository $movementRepository,
        PaymentMethodRepository $paymentMethodRepository
    )
    {
        $this->movementRepository = $movementRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
    }
    
    public function getClassName()
    {
        return class_basename($this);
    }
    
    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    
    /**
     * @param $transaction
     * @param $request
     * @throws ServerErrorException
     */
    public function handleTransactionCallback(Transaction $transaction, Request $request)
    {
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
            \Log::warning('Transaction in final status received a status update',[
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
            if ($transaction->status != $request->input('status')) {
                \Log::emergency('Transaction in final status received a status MISMATCH',[
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
            }
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
        
            $this->movementRepository->reverseMovements($transaction->movement_code);
        }
    
        if ($transaction->status == config('business.transaction.status.success')) {
            if ($transaction->is_account_topup) {
                if ($this->paymentMethodRepository->confirmTopupMethod($transaction->user, $transaction->service->payment_method)) {
                    \Log::info("{$this->getClassName()}: The account top up method has been successfully confirmed for this topup transaction");
                } else {
                    \Log::error("{$this->getClassName()}: There was an error confirming the top up account method for this top up transaction");
                }
            }
        }
    
        \Log::info("{$this->getClassName()}: Completing movement for this transaction. To be counted in the balance for withdrawals");
    
        $this->movementRepository->completeMovements($transaction->movement_code);
    }
    
    public function callbackSuccessResponse()
    {
        return response()->json([
            'status' => 'OK'
        ], 200);
    }
}
