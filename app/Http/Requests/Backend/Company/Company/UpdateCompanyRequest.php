<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/22/20
 * Time: 10:26 PM
 */

namespace App\Http\Requests\Backend\Company\Company;

use Illuminate\Validation\Rule;
use App\Rules\Company\UpdateCompanyTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Company\UpdateCompanyNameRule;

class UpdateCompanyRequest extends FormRequest
{
    
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'          => __('validation.attributes.backend.companies.company.name'),
            'email'         => __('validation.attributes.backend.companies.company.email'),
            'phone'         => __('validation.attributes.backend.companies.company.phone'),
            'address'       => __('validation.attributes.backend.companies.company.address'),
            'website'       => __('validation.attributes.backend.companies.company.website'),
            'street'        => __('validation.attributes.backend.companies.company.street'),
            'city'          => __('validation.attributes.backend.companies.company.city'),
            'state'         => __('validation.attributes.backend.companies.company.state'),
            'postal_code'   => __('validation.attributes.backend.companies.company.postal_code'),
            'country_id'    => __('validation.attributes.backend.companies.company.country'),
            'size'          => __('validation.attributes.backend.companies.company.size'),
            'type_id'       => __('validation.attributes.backend.companies.company.type'),
            'logo'          => __('validation.attributes.backend.companies.company.logo'),
            'is_provider'   => __('validation.attributes.backend.companies.company.provider'),

        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name'          => [
                'required',
                'max:191',
                Rule::unique('companies', 'name')->ignore(request()->company->uuid, 'uuid'),
                new UpdateCompanyNameRule()],
            'email'         => 'max:191',
            'phone'         => 'required|max:191',
            'address'       => 'required|max:191',
            'website'       => 'max:191',
            'street'        => 'max:191',
            'city'          => 'required|max:191',
            'state'         => 'required|max:191',
            'postal_code'   => 'max:191',
            'country_id'    => ['required', Rule::exists('countries', 'uuid')],
            'size'          => 'max:5',
            'type_id'       => ['required', new UpdateCompanyTypeRule()],
            'is_provider'   => ['sometimes', 'boolean'],
            'logo'          => 'sometimes|image|max:191',
        ];
    }
}
