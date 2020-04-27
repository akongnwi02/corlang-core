<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/27/20
 * Time: 1:20 AM
 */

namespace App\Http\Requests\Frontend\User;


use Illuminate\Foundation\Http\FormRequest;

class CreatePinRequest extends FormRequest
{
    public function authorize()
    {
        return ! auth()->user()->pincode;
    }
    
    public function attributes()
    {
        return [
            'pin' => __('validation.attributes.frontend.new_pin'),
        ];
    }
    
    public function messages()
    {
        return [
            'pin.regex' =>  __('auth.invalid_pin'),
        ];
    }
    
    public function rules()
    {
        return [
            'pin'     => ['required', 'confirmed', 'regex:/^\d{4}$/'],
        ];
    }
}
