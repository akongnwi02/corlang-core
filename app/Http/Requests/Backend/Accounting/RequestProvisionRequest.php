<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/3/20
 * Time: 11:12 PM
 */

namespace App\Http\Requests\Backend\Accounting;


use App\Rules\Accounting\SufficientProvisionAmountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestProvisionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->is_default;
    }
    
    public function attributes()
    {
        return [
            'amount'      => __('validation.attributes.backend.accounting.provision.amount'),
            'currency_id' => __('validation.attributes.backend.accounting.provision.currency'),
            'comment'     => __('validation.attributes.backend.accounting.provision.comment'),
        ];
    }
    
    public function rules()
    {
        return [
            'amount'      => ['required', 'numeric', 'min:100', new SufficientProvisionAmountRule()],
            'comment'     => ['max:191', 'string', 'nullable'],
            'currency_id' => ['required', Rule::exists('currencies', 'uuid')]
        ];
    }
}
