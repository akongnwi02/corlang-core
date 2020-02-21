<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 7:41 PM
 */

namespace App\Http\Requests\Backend\Account;


use Illuminate\Foundation\Http\FormRequest;

class AccountStatusRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->company->isDefault();
    }
    
    public function rules()
    {
        return [];
    }
}
