<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/11/20
 * Time: 12:28 AM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Business\PayoutRequest;
use App\Models\System\Currency;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;

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
    
    public function payout(PayoutRequest $request, PaymentMethodRepository $paymentMethodRepository)
    {
        $paymentMethod = $paymentMethodRepository->findByCode($request->paymentmethod_code);
    
        if (!$paymentMethod->is_default) {
            // TODO to be continued
            
        }
        
    }
}
