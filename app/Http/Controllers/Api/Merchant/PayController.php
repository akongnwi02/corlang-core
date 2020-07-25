<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/13/20
 * Time: 5:58 PM
 */

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Merchant\V1\PayRequest;
use App\Http\Resources\Api\TransactionResource;
use App\Jobs\Merchant\Order\ProcessOrderJob;
use App\Models\Merchant\MerchantOrder;
use App\Repositories\Api\Business\TransactionRepository;
use App\Repositories\Backend\Movement\MovementRepository;

class PayController extends Controller
{
    /**
     * @param PayRequest $request
     * @param MerchantOrder $order
     * @param TransactionRepository $transactionRepository
     * @param MovementRepository $movementRepository
     * @return TransactionResource
     */
    public function pay(
        PayRequest $request,
        MerchantOrder $order,
        TransactionRepository $transactionRepository,
        MovementRepository $movementRepository
    )
    {
        \Log::info('Incoming merchant payment request', ['input' =>request()->input()]);
    
        $transaction = $transactionRepository->createTransactionForOrder($order, $request->input());
        $movementRepository->registerOrderSale($order->company->account, $transaction);
    
        $order->refresh();
        
        dispatch(new ProcessOrderJob($order))->onQueue(config('business.transaction.queue.merchant.process'));
        
        return new TransactionResource($order->transaction);
    }
}
