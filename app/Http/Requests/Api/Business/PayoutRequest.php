<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/11/20
 * Time: 12:04 AM
 */

namespace App\Http\Requests\Api\Business;

use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PayoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules(PaymentMethodRepository $paymentMethodRepository)
    {
        $defaultMethod = $paymentMethodRepository->defaultPaymentMethod();
        return [
            'amount'             => ['required', 'numeric', 'min:50',],
            'account'            => ["required_unless:paymentmethod_code,$defaultMethod->code",],
            'name'               => ["required_unless:paymentmethod_code,$defaultMethod->code",],
            'currency_code'      => ['required', Rule::exists('currencies', 'code')],
            'paymentmethod_code' => ['required', Rule::exists('paymentmethods', 'code')],
        ];
    }
}
