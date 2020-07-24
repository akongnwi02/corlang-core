<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/24/20
 * Time: 10:46 PM
 */

namespace App\Http\Requests\Api\Merchant\V1;


use Illuminate\Foundation\Http\FormRequest;

class DeleteOrderRequest extends FormRequest
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
