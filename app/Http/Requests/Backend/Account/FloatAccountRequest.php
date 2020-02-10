<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 7:41 PM
 */

namespace App\Http\Requests\Backend\Account;


use App\Models\Company\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FloatAccountRequest extends FormRequest
{
    public function authorize()
    {
        if ($this->user()->company->isDefault()
            // only float account for the default company
            // all other accounts obey double entry.
            && (Company::where('is_default', true)->first()->account == request()->account)
            && request()->account->company->is_active
            && request()->account->is_active) {
            return true;
        }
        \Log::error('The request could not be performed', [
            'account status' => request()->account->is_active,
            'company status' => request()->account->company->is_active,
        ]);
        
        return false;
    }
    
    public function attributes()
    {
        return [
            'amount' => __('validation.attributes.backend.account.amount'),
            'currency_id' => __('validation.attributes.backend.account.currency')
        ];
    }
    
    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'min:0'],
            'currency_id' => ['required', Rule::exists('currencies', 'uuid')]
        ];
    }
}
