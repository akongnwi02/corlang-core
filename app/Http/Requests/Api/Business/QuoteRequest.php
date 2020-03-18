<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/6/20
 * Time: 5:21 PM
 */

namespace App\Http\Requests\Api\Business;

use App\Rules\Business\ItemExistRule;
use App\Rules\Service\PaymentMethodAccessRule;
use App\Rules\Service\ServiceAccessRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuoteRequest extends FormRequest
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
            'destination' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            
            'service_code' => ['required', new ServiceAccessRule(),],
            
            'amount' => ['sometimes', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/'],
            
            'currency_code' => ['required', Rule::exists('currencies', 'code')],
            
            'items' => ['sometimes', new ItemExistRule()],
            
            'reference' => ['sometimes', 'nullable', 'string', 'min:3'],
            
            'source_code' => ['sometimes', 'nullable', 'string', new PaymentMethodAccessRule()],
        ];
    }
}
