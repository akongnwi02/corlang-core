<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/13/20
 * Time: 9:32 PM
 */

namespace App\Http\Requests\Api\Merchant\V1;


use App\Rules\Service\PaymentMethodAccessRule;
use App\Rules\Service\PaymentMethodDestinationRule;
use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
{
    public function authorize()
    {
        return request()->order->status == config('business.transaction.status.created');
    }
    
    public function rules()
    {
        return [
            'destination' => ['required', 'string', 'max:32', new PaymentMethodDestinationRule],
            'paymentmethod_code' => ['required', 'string', 'max:32', new PaymentMethodAccessRule],
        ];
    }
}
