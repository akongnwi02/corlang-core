<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/12/20
 * Time: 10:20 PM
 */

namespace App\Http\Requests\Backend\Services\PaymentMethod;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'customercommission_id' => __('validation.attributes.backend.services.method.providercommission'),
            'providercommission_id' => __('validation.attributes.backend.services.method.customercommission'),
            'name'                  => __('validation.attributes.backend.services.method.name'),
            'description_en'        => __('validation.attributes.backend.services.method.description_en'),
            'description_fr'        => __('validation.attributes.backend.services.method.description_fr'),
            'service_id'            => __('validation.attributes.backend.services.method.service'),
        ];
    }
    
    public function rules()
    {
        return [
            'customercommission_id' => ['sometimes', 'nullable', Rule::exists('commissions', 'uuid')],
            'providercommission_id' => ['sometimes', 'nullable', Rule::exists('commissions', 'uuid')],
            'name'                  => ['required', 'string', 'max:191', Rule::unique('paymentmethods', 'name')],
            'description_en'        => ['required', 'string', 'max:191'],
            'description_fr'        => ['required', 'string', 'max:191'],
            'service_id'            => ['nullable', Rule::exists('services', 'uuid')],
        ];
    }
}
