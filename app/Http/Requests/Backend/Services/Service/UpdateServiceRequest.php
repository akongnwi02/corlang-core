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
use Illuminate\Validation\Rules\RequiredIf;

class UpdateServiceRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'name'                    => __('validation.attributes.backend.services.service.name'),
            'description_en'          => __('validation.attributes.backend.services.service.description_en'),
            'description_fr'          => __('validation.attributes.backend.services.service.description_fr'),
            'category_id'             => __('validation.attributes.backend.services.service.category'),
            'is_active'               => __('validation.attributes.backend.services.service.active'),
            'code'                    => __('validation.attributes.backend.services.service.code'),
            'destination_placeholder' => __('validation.attributes.backend.services.service.destination_placeholder'),
            'destination_regex'       => __('validation.attributes.backend.services.service.destination_regex'),
            'providercommission_id'   => __('validation.attributes.backend.services.service.providercommission'),
            'customercommission_id'   => __('validation.attributes.backend.services.service.customercommission'),
            'providercompany_id'      => __('validation.attributes.backend.services.service.providercompany'),
            'agent_rate'              => __('validation.attributes.backend.services.service.agent_rate'),
            'company_rate'            => __('validation.attributes.backend.services.service.company_rate'),
            'external_rate'           => __('validation.attributes.backend.services.service.external_rate'),
            'min_amount'              => __('validation.attributes.backend.services.service.min_amount'),
            'max_amount'              => __('validation.attributes.backend.services.service.max_amount'),
            'step_amount'              => __('validation.attributes.backend.services.service.step_amount'),
            'logo'                    => __('validation.attributes.backend.services.service.logo'),
            'logo_url'                    => __('validation.attributes.backend.services.service.logo_url'),
            'items'                   => __('validation.attributes.backend.services.service.items'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'                    => ['required', 'string', 'max:191', Rule::unique('services', 'name')->ignore(request()->service, 'uuid')],
            'description_en'          => ['nullable', 'string', 'max:191'],
            'description_fr'          => ['nullable', 'string', 'max:191'],
            'destination_placeholder' => ['nullable', 'string', 'max:191',],
            'destination_regex'       => ['nullable', 'string', 'max:191',],
            'category_id'             => ['required', Rule::exists('categories', 'uuid')],
            // 'code'                 => ['sometimes', 'string', 'max:191', Rule::unique('services', 'code')->ignore(request()->service, 'uuid')],
            'providercommission_id'   => ['nullable', Rule::exists('commissions', 'uuid')],
            'customercommission_id'   => ['nullable', Rule::exists('commissions', 'uuid')],
            'providercompany_id'      => ['nullable', Rule::exists('companies', 'uuid')],
            'agent_rate'              => ['required', 'numeric', 'between:0,100'],
            'company_rate'            => ['required', 'numeric', 'between:0,100'],
            'external_rate'           => ['required', 'numeric', 'between:0,100'],
            'min_amount'              => ['required', 'numeric', 'min:0'],
            'max_amount'              => ['required', 'numeric', 'min:0'],
            'step_amount'              => ['required', 'numeric', 'gt:0'],
            'logo'                    => 'sometimes|image|max:191',
            'logo_rul'                => 'nullable|string|max:256',
            'items'                   => ['sometimes', 'array', new ItemRule(),]
        ];
    }
}
