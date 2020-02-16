<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/14/20
 * Time: 5:33 PM
 */

namespace App\Http\Requests\Backend\Account;


use App\Exceptions\GeneralException;
use App\Rules\Account\SufficientBalanceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreditAccountRequest extends FormRequest
{
    /**
     * @return bool
     * @throws GeneralException
     */
    public function authorize()
    {
    
        if (! auth()->user()->company->is_active) {
            throw new GeneralException(__('exceptions.backend.companies.company.inactive'));
        }
    
        if (! request()->account->is_active || ! auth()->user()->company->account->is_active) {
            throw new GeneralException(__('exceptions.backend.account.inactive'));
        }

        if (request()->account->type->name == config('business.account.type.company')) {
            if (request()->account->company->isDefault()) {
                \Log::error('trying to credit the default company account. Apply float instead');
                return false;
            }
        }
    
        return true;
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
            'amount' => ['required', 'numeric', 'min:100', new SufficientBalanceRule()],
            'direction' => 'required|string|in:IN,OUT',
            'currency_id' => ['required', Rule::exists('currencies', 'uuid')]
        ];
    }
}
