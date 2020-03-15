<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 2:11 PM
 */

namespace App\Http\Requests\Backend\Services\Service;


use App\Rules\Service\ItemRule;
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
            'description_en'        => __('validation.attributes.backend.services.service.description_en'),
            'description_fr'        => __('validation.attributes.backend.services.service.description_fr'),
            'category_id'           => __('validation.attributes.backend.services.service.category'),
            'gateway_id'            => __('validation.attributes.backend.services.service.gateway'),
            'is_active'             => __('validation.attributes.backend.services.service.active'),
            'code'                  => __('validation.attributes.backend.services.service.code'),
            'providercommission_id' => __('validation.attributes.backend.services.service.providercommission'),
            'customercommission_id' => __('validation.attributes.backend.services.service.customercommission'),
            'providercompany_id'    => __('validation.attributes.backend.services.service.providercompany'),
            'agent_rate'            => __('validation.attributes.backend.services.service.agent_rate'),
            'company_rate'          => __('validation.attributes.backend.services.service.company_rate'),
            'logo'                  => __('validation.attributes.backend.services.service.logo'),
            'items'                 => __('validation.attributes.backend.services.service.items'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'                  => ['required', 'string', 'max:191', Rule::unique('services', 'name')->ignore(request()->service, 'uuid')],
            'description_en'        => ['nullable', 'string', 'max:191'],
            'description_fr'        => ['nullable', 'string', 'max:191'],
            'category_id'           => ['required', Rule::exists('categories', 'uuid')],
            'gateway_id'            => ['nullable', Rule::exists('gateways', 'uuid')],
//            'code'                  => ['sometimes', 'string', 'max:191', Rule::unique('services', 'code')->ignore(request()->service, 'uuid')],
            'providercommission_id' => ['nullable', Rule::exists('commissions', 'uuid')],
            'customercommission_id' => ['nullable', Rule::exists('commissions', 'uuid')],
            'providercompany_id'    => ['nullable', Rule::exists('companies', 'uuid')],
            'agent_rate'            => ['required', 'numeric', 'between:0,100'],
            'company_rate'          => ['required', 'numeric', 'between:0,100'],
            'logo'                  => 'sometimes|image|max:191',
            'items'                 => ['sometimes', 'array', new ItemRule(),]
        
        ];
    }
}
