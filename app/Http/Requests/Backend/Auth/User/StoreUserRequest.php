<?php

namespace App\Http\Requests\Backend\Auth\User;

use App\Rules\Auth\RightCompanyRule;
use App\Rules\Auth\RightRoleRule;
use App\Rules\Auth\UniquePhoneNumber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUserRequest.
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'phone'                => __('validation.attributes.backend.access.users.phone'),
            'first_name'           => __('validation.attributes.backend.access.users.first_name'),
            'last_name'            => __('validation.attributes.backend.access.users.last_name'),
            'username'             => __('validation.attributes.backend.access.users.username'),
            'email'                => __('validation.attributes.backend.access.users.email'),
            'notification_channel' => __('validation.attributes.backend.access.users.notification_channel'),
            'password'             => __('validation.attributes.backend.access.users.password'),
            'roles'                => __('validation.attributes.backend.access.users.associated_roles'),
            'company_id'           => __('validation.attributes.backend.access.users.company'),
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
            'first_name'           => 'required|max:191',
            'last_name'            => 'required|max:191',
            'username'             => ['required', 'max:191', Rule::unique('users', 'username')],
            'phone'                => ['required', 'max:191', new UniquePhoneNumber(), 'regex:/^(237|00237|\+237)?[6|2|3]{1}\d{8}$/'],
            'email'                => ['required', 'email', 'max:191', Rule::unique('users', 'email')],
            'notification_channel' => ['in:sms,mail', 'required',],
            'password'             => 'required|min:6|confirmed',
            'roles'                => ['required', 'array', new RightRoleRule()],
            'company_id'           => ['nullable', Rule::exists('companies','uuid'), new RightCompanyRule()],
        ];
    }
}
