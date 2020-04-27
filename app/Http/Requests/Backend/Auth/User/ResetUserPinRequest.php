<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/27/20
 * Time: 1:33 AM
 */

namespace App\Http\Requests\Backend\Auth\User;


use Illuminate\Foundation\Http\FormRequest;

class ResetUserPinRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->isDefault()
            || auth()->user()->company == request()->user->company;
    }
    
    public function attributes()
    {
        return [];
    }
    
    public function rules()
    {
        return [];
    }
}
