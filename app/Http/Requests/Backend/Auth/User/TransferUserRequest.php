<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/22/20
 * Time: 12:55 AM
 */

namespace App\Http\Requests\Backend\Auth\User;


use App\Rules\Auth\RightRoleRule;
use Arcanedev\Support\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferUserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'roles'      => __('validation.attributes.backend.access.users.associated_roles'),
            'company_id' => __('validation.attributes.backend.access.users.company'),
        ];
    }
    
    public function rules()
    {
        return [
            'roles'      => ['required', 'array', new RightRoleRule()],
            'company_id' => ['required', Rule::exists('companies','uuid')],
        ];
    }
}
