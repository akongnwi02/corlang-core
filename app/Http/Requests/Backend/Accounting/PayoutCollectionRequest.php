<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/2/20
 * Time: 1:45 AM
 */

namespace App\Http\Requests\Backend\Accounting;


use App\Rules\Accounting\SufficientCollectedAmountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PayoutCollectionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->is_default;
    }
    
    
    public function attributes()
    {
        return [
            'amount'      => __('validation.attributes.backend.accounting.collection.amount'),
            'currency_id' => __('validation.attributes.backend.accounting.collection.currency'),
            'comment'     => __('validation.attributes.backend.accounting.collection.comment'),
        ];
    }
    
    public function rules()
    {
        return [
            'amount'      => ['required', 'numeric', 'min:100', new SufficientCollectedAmountRule()],
            'comment'   => ['max:191', 'string', 'nullable'],
            'currency_id' => ['required', Rule::exists('currencies', 'uuid')]
        ];
    }
}
