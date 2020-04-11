<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/11/20
 * Time: 12:04 AM
 */

namespace App\Http\Requests\Api\Business;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PayoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'amount'             => ['required', 'numeric', 'min:50'],
            'comment'            => ['sometimes', 'nullable', 'max:191', 'string',],
            'currency_code'      => ['required', Rule::exists('currencies', 'code')],
            'paymentmethod_code' => ['string', Rule::exists('paymentmethods', 'code')],
            'account'            => ['sometimes', 'nullable', 'string', 'min:6']
        ];
    }
}
