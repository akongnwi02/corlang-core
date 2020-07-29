<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/29/20
 * Time: 11:42 PM
 */

namespace App\Http\Requests\Backend\Services\Commission;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommissionDistributionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'name'          => __('validation.attributes.backend.services.commission_distribution.name'),
            'description'   => __('validation.attributes.backend.services.commission_distribution.description'),
            'agent_rate'    => __('validation.attributes.backend.services.commission_distribution.agent_rate'),
            'company_rate'  => __('validation.attributes.backend.services.commission_distribution.company_rate'),
            'external_rate' => __('validation.attributes.backend.services.commission_distribution.external_rate'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'          => ['required', 'string', Rule::unique('commission_distributions', 'name')],
            'description'   => 'required|string|max:191',
            'agent_rate'    => ['required', 'numeric', 'between:0,100'],
            'company_rate'  => ['required', 'numeric', 'between:0,100'],
            'external_rate' => ['required', 'numeric', 'between:0,100'],
        ];
    }
}
