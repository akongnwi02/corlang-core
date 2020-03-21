<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:25 PM
 */

namespace App\Services\Business\Validators;


use App\Rules\Service\PaymentMethodAccessRule;
use App\Rules\Service\ServiceAccessRule;
use Illuminate\Validation\Rule;

class PrepaidBillsValidator
{
    public function validate($request)
    {
        validator($request, [
            'destination'        => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'service_code'       => ['required', new ServiceAccessRule(),],
            'amount'             => ['required', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/'],
            'currency_code'      => ['required', Rule::exists('currencies', 'code')],
            'reference'          => ['sometimes', 'nullable', 'string', 'min:3'],
            'phone'              => ['required', 'string', 'min:9'],
            'paymentmethod_code' => ['sometimes', 'nullable', 'string', new PaymentMethodAccessRule()],
        ]);
    }
}
