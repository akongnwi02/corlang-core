<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/8/19
 * Time: 9:58 PM
 */

namespace App\Http\Requests\Api\Auth;


use Arcanedev\Support\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'email'        => ['required', 'string', 'email', 'min:5'],
            'password'     => 'required|string|min:3',
        ];
    }
}