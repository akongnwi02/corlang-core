<?php

namespace App\Http\Requests\Backend\Auth\User;

use App\Rules\Auth\RightRoleRule;
use App\Rules\Company\RightCompanyRule;
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
        if (auth()->user()->company->isDefault()
            || auth()->user()->company == request()->user->company) {
        
            if (auth()->user()->id == 1) {
                return true;
            }
        
            if (auth()->user()->isAdmin()) {
                return (! request()->user->isAdmin());
            }
        
            if (auth()->user()->isCompanyAdmin()) {
                return (! request()->user->isAdmin())
                    && (! request()->user->isCompanyAdmin());
            }
        
            if (auth()->user()->isBranchAdmin()) {
                return (! request()->user->isAdmin())
                    && (! request()->user->isCompanyAdmin())
                    && (! request()->user->isBranchAdmin());
            }
        }
    
        \Log::error('You do not have enough rights to update this user');
        return false;
    }

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
            'roles'                => __('validation.attributes.backend.access.users.associated_roles'),
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
            'roles'                => ['required', 'array', new RightRoleRule()],
        ];
    }
}
