<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/15/20
 * Time: 1:43 PM
 */

namespace App\Http\Requests\Backend\Administration\Currency;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'name' => __('validation.attributes.backend.administration.currency.name'),
            'code' => __('validation.attributes.backend.administration.currency.code'),
            'rate' => __('validation.attributes.backend.administration.currency.rate'),
        ];
    }
    
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191', Rule::unique('currencies', 'name')],
            'code' => ['required', 'string', 'max:191', Rule::unique('currencies', 'code')],
            'rate' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
