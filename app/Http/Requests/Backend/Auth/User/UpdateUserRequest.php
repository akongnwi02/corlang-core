<?php

namespace App\Http\Requests\Backend\Auth\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends FormRequest
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
            'phone' => 'Phone Number',
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
            'email'                => 'required|email|max:191',
            'phone'                => ['required', 'max:191', 'regex:/^(237|00237|\+237)?[6|2|3]{1}\d{8}$/'],
            'notification_channel' => ['in:sms,mail', 'required',],
            'username'             => 'required|max:191',
            'first_name'           => 'required|max:191',
            'last_name'            => 'required|max:191',
            'roles'                => 'required|array',
        ];
    }
}
