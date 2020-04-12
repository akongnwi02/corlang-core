<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/19/20
 * Time: 6:18 PM
 */

namespace App\Http\Requests\Backend\Account;


use App\Exceptions\GeneralException;
use App\Rules\Account\SufficientCommissionBalanceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestPayoutRequest extends FormRequest
{
    public function authorize()
    {
        if (!auth()->user()->company->is_active) {
            throw new GeneralException(__('exceptions.backend.companies.company.inactive'));
        }
        
        if (!auth()->user()->company->account->is_active) {
            throw new GeneralException(__('exceptions.backend.account.inactive'));
        }
        
        if (request()->account->type->name == config('business.account.type.user')) {
            if (request()->account->is_default) {
                return auth()->user()->company->is_default && auth()->user()->isAdmin();
            }
            return request()->account->user->uuid == auth()->user()->uuid;
        }
        
        if (request()->account->type->name == config('business.account.type.company')) {
            return request()->account->company->uuid == auth()->user()->company->uuid
                && auth()->user()->isAdmin()
                || auth()->user()->isCompanyAdmin();
        }
        
        return false;
    }
    
    public function attributes()
    {
        return [
            'amount'           => __('validation.attributes.backend.account.amount'),
            'currency_id'      => __('validation.attributes.backend.account.currency'),
            'name'             => __('validation.attributes.backend.account.name'),
            'paymentmethod_id' => __('validation.attributes.backend.account.payment_method'),
            'account_number'   => __('validation.attributes.backend.account.number'),
        ];
    }
    
    public function rules()
    {
        return [
            'amount'           => ['required', 'numeric', 'min:100', new SufficientCommissionBalanceRule()],
            'name'          => ['max:191', 'string', 'nullable'],
            'currency_id'      => ['required', Rule::exists('currencies', 'uuid')],
            'paymentmethod_id' => ['sometimes', 'nullable', Rule::exists('paymentmethods', 'uuid')],
            'account_number'   => ['required', 'string', 'max:191'],
        ];
    }
}
