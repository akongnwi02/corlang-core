<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/6/20
 * Time: 5:21 PM
 */

namespace App\Http\Requests\Api\Business;


use App\Rules\Service\ServiceAccessRule;
use App\Rules\Service\ActiveServiceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuoteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'destination' => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'destination_code' => [
                'required',
                new ServiceAccessRule(),
            ],
            'amount' => ['sometimes', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/'],
            'currency_code' => ['required', Rule::exists('currencies', 'code')],
            'items' => ['sometimes', 'array']
        ];
    }
}
