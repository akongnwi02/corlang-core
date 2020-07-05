<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/14/20
 * Time: 5:33 PM
 */

namespace App\Http\Requests\Backend\Account;


use App\Exceptions\GeneralException;
use App\Rules\Account\SufficientDrainAmountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DrainAccountRequest extends FormRequest
{
    /**
     * @return bool
     * @throws GeneralException
     */
    public function authorize()
    {
        if (!auth()->user()->company->is_active) {
            throw new GeneralException(__('exceptions.backend.companies.company.inactive'));
        }
        
        if (! auth()->user()->company->account->is_active) {
            throw new GeneralException(__('exceptions.backend.account.inactive'));
        }
        
        if (request()->account->type->name == config('business.account.type.user')) {
            return auth()->user()->company->isDefault() || request()->account->user->company->uuid == auth()->user()->company->uuid;
        }
        
        return false;
    }
    
    public function attributes()
    {
        return [
            'amount'      => __('validation.attributes.backend.account.amount'),
            'currency_id' => __('validation.attributes.backend.account.currency'),
            'comment' => __('validation.attributes.backend.account.comment'),
        ];
    }
    
    public function rules()
    {
        return [
            'amount'      => ['required', 'numeric',],
            'comment'   => ['max:191', 'string', 'nullable'],
            'currency_id' => ['required', Rule::exists('currencies', 'uuid')]
        ];
    }
}
