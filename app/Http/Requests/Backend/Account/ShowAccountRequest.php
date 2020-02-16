<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/13/20
 * Time: 10:15 PM
 */

namespace App\Http\Requests\Backend\Account;


use Illuminate\Foundation\Http\FormRequest;

class ShowAccountRequest extends FormRequest
{
    
    public function authorize()
    {
        if (auth()->user()->company->isDefault()) {
            return true;
        }
    
        if (request()->account->type->name == config('business.account.type.user')) {
            return auth()->user()->company == request()->account->user->company;
        }
        
        if (request()->account->type->name == config('business.account.type.company')) {
            return auth()->user()->company == request()->account->company;
        }
        
        return false;
    }
    
    public function rules()
    {
        return [];
    }
}
