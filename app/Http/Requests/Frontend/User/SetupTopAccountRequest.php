<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/1/20
 * Time: 11:41 PM
 */

namespace App\Http\Requests\Frontend\User;


use Illuminate\Foundation\Http\FormRequest;

class SetupTopAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function attributes()
    {
        return [
            'topup_config' => __('validation.attributes.frontend.topup.config')
        ];
    }
    
    public function rules()
    {
        return [
            'topup_config' => 'required|array',
        ];
    }
}
