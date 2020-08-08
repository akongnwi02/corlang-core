<?php

namespace App\Http\Requests\Backend\Company\Company;

use App\Models\Company\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreUserRequest.
 */
class CompanyServiceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->company->isDefault()
            || ($this->user()->company == request()->company);
    }
    
    public function attributes()
    {
        return [
            'providercommission_id' => __('validation.attributes.backend.companies.service.providercommission'),
            'customercommission_id' => __('validation.attributes.backend.companies.service.customercommission'),
            'commission_distribution_id' => __('validation.attributes.backend.companies.service.commissiondistribution'),
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agent_rate'            => 'sometimes|numeric|between:0,100',
            'company_rate'          => 'sometimes|numeric|between:0,100',
            'external'              => 'sometimes|numeric|between:0,100',
            'providercommission_id' => ['nullable', Rule::exists('commissions', 'uuid')],
            'customercommission_id' => ['nullable', Rule::exists('commissions', 'uuid')],
            'commission_distribution_id' => ['nullable', Rule::exists('commission_distributions', 'uuid')],
        ];
    }
}
