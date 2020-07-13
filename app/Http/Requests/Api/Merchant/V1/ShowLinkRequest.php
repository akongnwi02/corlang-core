<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/11/20
 * Time: 10:54 PM
 */

namespace App\Http\Requests\Api\Merchant\V1;


use Illuminate\Foundation\Http\FormRequest;

class ShowLinkRequest extends FormRequest
{
    public function authorize()
    {
        return request()->order->status == config('business.transaction.status.created');
    }
    
    public function rules()
    {
        return [];
    }
}
