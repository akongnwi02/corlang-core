<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/12/20
 * Time: 12:52 AM
 */

namespace App\Http\Requests\Api\Business;


use App\Rules\Service\PaymentMethodAccessRule;
use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
{
    public function authorize()
    {
        if (auth()->user()->company_id) {
            return auth()->user()->company->is_active;
        }
    }
    
    public function rules()
    {
        return [
            'quote_id' => ['required', 'string', 'min:10'],
            'reference' => ['sometimes', 'nullable', 'string', 'min:3'],
            'source_code' => [
                'sometimes',
                'nullable',
                'string',
                new PaymentMethodAccessRule()
            ],
            'items' => ['sometimes', 'nullable', 'array'],
        ];
    }
}
