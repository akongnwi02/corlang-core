<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 2:11 PM
 */

namespace App\Http\Requests\Backend\Services\Service;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'name'                  => __('validation.attributes.backend.services.service.name'),
            'category_id'           => __('validation.attributes.backend.services.service.category'),
            'gateway_id'            => __('validation.attributes.backend.services.service.gateway'),
            'code'                  => __('validation.attributes.backend.services.service.code'),
            'providercommission_id' => __('validation.attributes.backend.services.service.providercommission'),
            'customercommission_id' => __('validation.attributes.backend.services.service.customercommission'),
            'providercompany_id'    => __('validation.attributes.backend.services.service.providercompany'),
            'agent_rate'            => __('validation.attributes.backend.services.service.agent_rate'),
            'company_rate'          => __('validation.attributes.backend.services.service.company_rate'),
            'logo'                  => __('validation.attributes.backend.services.service.logo'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'                  => ['required', 'string', 'max:191', Rule::unique('services', 'name')],
            'category_id'           => ['required', Rule::exists('categories', 'uuid'), 'nullable'],
            'gateway_id'            => ['sometimes', Rule::exists('gateways', 'uuid'), 'nullable'],
            'code'                  => ['required', 'string', 'max:191', Rule::unique('services', 'code')],
            'providercommission_id' => ['sometimes', Rule::exists('commissions', 'uuid'), 'nullable'],
            'customercommission_id' => ['sometimes', Rule::exists('commissions', 'uuid'), 'nullable'],
            'providercompany_id'    => ['sometimes', Rule::exists('companies', 'uuid'), 'nullable'],
            'agent_rate'            => ['required', 'numeric', 'between:0,100'],
            'company_rate'          => ['required', 'numeric', 'between:0,100'],
            'logo'                  => 'sometimes|image|max:191',
        ];
    }
}
