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

class UpdateServiceRequest extends FormRequest
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
            'is_active'             => __('validation.attributes.backend.services.service.active'),
            'code'                  => __('validation.attributes.backend.services.service.code'),
            'providercommission_id' => __('validation.attributes.backend.services.service.providercommission'),
            'customercommission_id' => __('validation.attributes.backend.services.service.customercommission'),
            'providercompany_id'    => __('validation.attributes.backend.services.service.providercompany'),
            'is_paymentmethod'      => __('validation.attributes.backend.services.service.is_payment_method'),
            'agent_rate'            => __('validation.attributes.backend.services.service.agent_rate'),
            'company_rate'          => __('validation.attributes.backend.services.service.company_rate'),
            'logo'                  => __('validation.attributes.backend.services.service.logo'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'                  => ['required', 'string', 'max:191', Rule::unique('services', 'name')->ignore(request()->service, 'uuid')],
            'category_id'           => ['required', Rule::exists('categories', 'uuid')],
            'gateway_id'            => ['sometimes', Rule::exists('gateways', 'uuid')],
            'code'                  => ['sometimes', 'string', 'max:191', Rule::unique('services', 'code')->ignore(request()->service, 'uuid')],
            'providercommission_id' => ['sometimes', Rule::exists('commissions', 'uuid')],
            'customercommission_id' => ['sometimes', Rule::exists('commissions', 'uuid')],
            'providercompany_id'    => ['sometimes', Rule::exists('companies', 'uuid')],
            'is_paymentmethod'      => ['sometimes', 'boolean'],
            'agent_rate'            => ['required', 'numeric', 'between:0,100'],
            'company_rate'          => ['required', 'numeric', 'between:0,100'],
            'logo'                  => 'sometimes|image|max:191',
        
        ];
    }
}
