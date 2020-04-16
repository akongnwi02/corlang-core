<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/15/20
 * Time: 8:41 PM
 */

namespace App\Http\Requests\Frontend\User;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePinRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function attributes()
    {
        return [
            'old_pin' => __('validation.attributes.frontend.old_pin'),
            'pin' => __('validation.attributes.frontend.new_pin'),
        ];
    }
    
    public function messages()
    {
        return [
            'old_pin.exists' => __('auth.not_found_pin'),
            'pin.regex' =>  __('auth.invalid_pin'),
        ];
    }
    
    public function rules()
    {
        return [
            'old_pin' => ['required', Rule::exists('users', 'pincode')->where('id', auth()->id())],
            'pin'     => ['required', 'confirmed', 'regex:/^\d{4}$/'],
        ];
    }
}
