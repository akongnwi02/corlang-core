<?php

namespace App\Http\Requests\Backend\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShowUserRequest.
 */
class UpdateUserStatusRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
