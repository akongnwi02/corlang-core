<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/10/20
 * Time: 12:13 AM
 */

namespace App\Http\Requests\Api\Merchant\V1;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            // customer
            'customer.name' => 'string',
            'customer.address' => 'string',
            'customer.phone' => 'string',
            'customer.email' => 'email',
            
            // order details
            'external_id' => ['required', Rule::unique('merchant_orders')],
            'total_amount' => 'required|numeric|min:0',
            'currency_code' => 'required|in:XAF',
            'description' => 'string|min',
            'language' => 'in:en,fr',
            
            'items.*.quantity' => 'numeric',
            'items.*.unit_cost' => 'numeric|min:0',
            'items.*.sub_total' => 'numeric|min:0',
            'items.*.code' => 'string',

            // developer
            'notification_url' => 'required|url',
            'return_url' => 'required|url',
            
        ];
    }
}
