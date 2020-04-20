<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/12/20
 * Time: 12:52 AM
 */

namespace App\Http\Requests\Api\Business;


use Illuminate\Foundation\Http\FormRequest;

class ConfirmPaymentRequest extends FormRequest
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

            'items' => ['sometimes', 'nullable', 'array'],
        ];
    }
}
