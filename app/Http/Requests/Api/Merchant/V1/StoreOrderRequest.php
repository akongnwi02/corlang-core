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

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->is_merchant;
    }
    
    public function rules()
    {
        return [
            // customer
            'customer.name' => 'nullable|string',
            'customer.address' => 'nullable|string',
            'customer.phone' => 'nullable|string',
            'customer.email' => 'nullable|email',
            
            // order details
            'external_id' => ['required', Rule::unique('merchant_orders')],
            'total_amount' => 'required|numeric|min:0',
            'currency_code' => Rule::exists('currencies', 'code'),
            'description' => 'nullable|string',
            
            'items' => 'array',
            'items.*.quantity' => 'nullable|numeric',
            'items.*.unit_cost' => 'nullable|numeric|min:0',
            'items.*.sub_total' => 'nullable|numeric|min:0',
            'items.*.code' => 'nullable|string',
            'items.*.name' => 'nullable|string',
            'items.*.description' => 'nullable|string',
            'items.*.logo_url' => 'nullable|url',

            // developer
            'notification_url' => 'nullable|url',
            'return_url' => 'required|url',
        ];
    }
}
