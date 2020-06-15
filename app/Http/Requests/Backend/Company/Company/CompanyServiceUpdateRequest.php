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
            'agent_rate'            => __('validation.attributes.backend.companies.service.agent_rate'),
            'company_rate'          => __('validation.attributes.backend.companies.service.company_rate'),
            'external_rate'         => __('validation.attributes.backend.companies.service.external_rate'),
            'providercommission_id' => __('validation.attributes.backend.companies.service.providercommission'),
            'customercommission_id' => __('validation.attributes.backend.companies.service.customercommission'),
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
        ];
    }
}
