<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/11/20
 * Time: 1:44 AM
 */

namespace App\Http\Requests\Api\Merchant\V1;


use Illuminate\Foundation\Http\FormRequest;

class ShowOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [];
    }
}
