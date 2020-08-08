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
            'name'                       => __('validation.attributes.backend.services.service.name'),
            'description_en'             => __('validation.attributes.backend.services.service.description_en'),
            'description_fr'             => __('validation.attributes.backend.services.service.description_fr'),
            'category_id'                => __('validation.attributes.backend.services.service.category'),
            'code'                       => __('validation.attributes.backend.services.service.code'),
            'providercommission_id'      => __('validation.attributes.backend.services.service.providercommission'),
            'customercommission_id'      => __('validation.attributes.backend.services.service.customercommission'),
            'providercompany_id'         => __('validation.attributes.backend.services.service.providercompany'),
            'commission_distribution_id' => __('validation.attributes.backend.services.service.commission_distribution_id'),
            'is_prepaid'                 => __('validation.attributes.backend.services.service.prepaid'),
            'logo'                       => __('validation.attributes.backend.services.service.logo'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'                       => ['required', 'string', 'max:191', Rule::unique('services', 'name')],
            'description_en'             => ['nullable', 'string', 'max:191',],
            'description_fr'             => ['nullable', 'string', 'max:191',],
            'category_id'                => ['required', Rule::exists('categories', 'uuid'), 'nullable'],
            'code'                       => ['required', 'string', 'max:191', Rule::unique('services', 'code')],
            'providercommission_id'      => ['sometimes', Rule::exists('commissions', 'uuid'), 'nullable'],
            'customercommission_id'      => ['sometimes', Rule::exists('commissions', 'uuid'), 'nullable'],
            'providercompany_id'         => ['sometimes', Rule::exists('companies', 'uuid'), 'nullable'],
            'commission_distribution_id' => ['nullable', Rule::exists('commission_distributions', 'uuid')],
            'is_prepaid'                 => ['sometimes', 'boolean'],
            'logo'                       => 'sometimes|image|max:191',
        ];
    }
}
