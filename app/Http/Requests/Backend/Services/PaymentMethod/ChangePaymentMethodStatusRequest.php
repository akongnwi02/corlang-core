<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/21/20
 * Time: 12:12 PM
 */

namespace App\Http\Requests\Backend\Services\PaymentMethod;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangePaymentMethodStatusRequest extends FormRequest
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
