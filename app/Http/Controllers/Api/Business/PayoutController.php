<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/14/20
 * Time: 1:46 AM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Controllers\Controller;
use App\Exceptions\Api\BadRequestException;
use App\Http\Requests\Api\Business\PayoutRequest;
use App\Http\Requests\Api\Business\CancelPayoutRequest;
use App\Http\Resources\Api\PayoutResource;
use App\Models\Account\Payout;
use App\Repositories\Backend\Account\PayoutRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Repositories\Backend\System\CurrencyRepository;
use App\Services\Constants\BusinessErrorCodes;

class PayoutController extends Controller
{
    /**
     * @param PayoutRequest $request
     * @param PaymentMethodRepository $paymentMethodRepository
     * @param PayoutRepository $payoutRepository
     * @param CurrencyRepository $currencyRepository
     * @return PayoutResource
     * @throws BadRequestException
     * @throws \App\Exceptions\Api\ServerErrorException
     */
    public function store(
        PayoutRequest $request,
        PaymentMethodRepository $paymentMethodRepository,
        PayoutRepository $payoutRepository,
        CurrencyRepository $currencyRepository
    )
    {
        $paymentMethod = $paymentMethodRepository->findByCode($request->paymentmethod_code);
        $currency      = $currencyRepository->findByCode($request->currency_code);
        
        
        if (!$paymentMethod->is_active) {
            throw new BadRequestException(BusinessErrorCodes::PAYMENT_METHOD_NOT_ACTIVE, 'The selected payout method is not active');
        }
        
        $account = auth()->user()->account;
        
        $data = [
            'name'             => $paymentMethod->is_default ? $account->user->full_name : $request->input('name'),
            'amount'           => $request->input('amount'),
            'account'          => $paymentMethod->is_default ? $account->code : $request->input('account') ,
            'currency_id'      => $currency->uuid,
            'paymentmethod_id' => $paymentMethod->uuid,
        ];
        
        if ($data['amount'] > $account->getCommissionBalance()) {
            throw new BadRequestException(BusinessErrorCodes::INSUFFICIENT_COMMISSION_BALANCE, 'Your balance is insufficient');
        }
        
        $payout = $payoutRepository->frontendPayout($account, $data);
        
        return new PayoutResource($payout);
    }
    
    public function index(PayoutRepository $payoutRepository)
    {
        $payouts = $payoutRepository->getAllPayouts(auth()->user()->account)->limit(5)->get();
        return PayoutResource::collection($payouts);
    }
    
    /**
     * @param CancelPayoutRequest $request
     * @param Payout $payout
     * @param PayoutRepository $payoutRepository
     * @return PayoutResource
     * @throws \App\Exceptions\Api\ServerErrorException
     */
    public function cancel(CancelPayoutRequest $request, Payout $payout, PayoutRepository $payoutRepository)
    {
        $payout = $payoutRepository->cancel($payout);
        
        return new PayoutResource($payout);
    }
}
