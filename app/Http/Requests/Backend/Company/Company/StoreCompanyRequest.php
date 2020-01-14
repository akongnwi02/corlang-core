<?php

namespace App\Http\Requests\Backend\Auth\User;

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
        return $this->user()->isAdmin()
            || $this->user()->isCompanyAdmin();
    }
    
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
    
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:191',
            'address'       => 'required|max:191',
            'country_id'    => ['required', Rule::exists('countries', 'id')],
            'state'         => 'required|max:191',
            'city'          => 'required|max:191',
            'phone'         => 'required|max:191',
            'user_owner_id' => ['required', Rule::exists('users', 'id')],
            'type_id'       => ['required', Rule::exists('companytypes', 'id')],
            'email'         => 'email|max:191',
            'street'        => 'string|max:191',
            'website'       => 'string|max:191',
            'postal_code'   => 'string|max:191',
            'size'          => 'integer|max:5',
        ];
    }
}
