<?php

namespace App\Http\Requests\Backend\Auth\User;

use App\Rules\Auth\UniquePhoneNumber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUserRequest.
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'phone' => 'phone number',
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
            'roles'                => 'required|array',
        ];
    }
}
