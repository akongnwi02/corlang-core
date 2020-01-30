<?php

namespace App\Http\Requests\Backend\Company\Company;

use App\Rules\Auth\UniquePhoneNumber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUserRequest.
 */
class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->company->isDefault();
    }
    
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
            'is_provider'   => __('validation.attributes.backend.companies.company.provider'),
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
            'name'          => ['required', 'max:191', Rule::unique('companies', 'name')],
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
            'type_id'       => ['required', Rule::exists('companytypes', 'uuid')],
            'is_provider'   => ['sometimes', 'boolean'],
        ];
    }
}
