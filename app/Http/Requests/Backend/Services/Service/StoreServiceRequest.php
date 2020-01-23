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
    
    public function attributes()
    {
        return [
            'name'                  => __('validation.attributes.backend.services.service.name'),
            'category_id'           => __('validation.attributes.backend.services.service.category'),
            'gateway_id'            => __('validation.attributes.backend.services.service.gateway'),
            'is_active'             => __('validation.attributes.backend.services.service.active'),
            'code'                  => __('validation.attributes.backend.services.service.code'),
            'providercommission_id' => __('validation.attributes.backend.services.service.providercommission'),
            'companycommission_id'  => __('validation.attributes.backend.services.service.companycommission'),
            'customercommission_id' => __('validation.attributes.backend.services.service.customercommission'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'                  => ['required', 'string', 'max:191', Rule::unique('services', 'name')],
            'category_id'           => ['required', Rule::exists('categories', 'uuid')],
            'gateway_id'            => ['sometimes', Rule::exists('gateways', 'uuid')],
            'is_active'             => ['required', 'boolean'],
            'code'                  => ['required', 'string', 'max:191', Rule::unique('services', 'code')],
            'providercommission_id' => ['sometimes', Rule::exists('commissions', 'uuid')],
            'companycommission_id'  => ['sometimes', Rule::exists('commissions', 'uuid')],
            'customercommission_id' => ['sometimes', Rule::exists('commissions', 'uuid')],
        ];
    }
}
