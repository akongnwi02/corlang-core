<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/11/20
 * Time: 12:28 AM
 */

namespace App\Http\Controllers\Api\Business;


use App\Exceptions\Api\BadRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Business\PayoutRequest;
use App\Models\System\Currency;
use App\Repositories\Backend\Account\PayoutRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Repositories\Backend\System\CurrencyRepository;
use App\Services\Constants\BusinessErrorCodes;

class AccountController extends Controller
{
    
    public function account()
    {
        $account = auth()->user()->account;
        
        return response()->json(
            array_merge($account->toArray(), [
                'balance' => number_format($account->getBalance(), 2),
                'commission' => number_format($account->getCommissionBalance(), 2),
                'currency_code' => Currency::where('is_default', true)->first()->code,
                'payouts' => $account->payouts->toArray(),
            ])
        );
    }
    
    /**
     * @param PayoutRequest $request
     * @param PaymentMethodRepository $paymentMethodRepository
     * @param PayoutRepository $payoutRepository
     * @throws BadRequestException
     */
    public function payout(
        PayoutRequest $request,
        PaymentMethodRepository $paymentMethodRepository,
        PayoutRepository $payoutRepository,
        CurrencyRepository $currencyRepository
    )
    {
        $paymentMethod = $paymentMethodRepository->findByCode($request->paymentmethod_code);
        $currency = $currencyRepository->findByCode($request->currency_code);
    
        if (! $paymentMethod->is_default) {
            if (!$request->has('') || !$request->input('account')) {
                
            }
        }
        
        $data = [
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'account' => $request->input('account'),
            'currency_id' => $currency->uuid,
            'paymentmethod_id' => $paymentMethod->uuid,
        ];
        
        if (! $paymentMethod->is_active) {
            throw new BadRequestException(BusinessErrorCodes::PAYMENT_METHOD_NOT_ACTIVE, 'The selected payout method is not active');
        }
        
        $account = auth()->user()->account;
        
        $payoutRepository->frontendPayout($account, $request->only(['amount', 'currency_code', 'paymentmethod_code', 'account', 'name']));
    }
}
