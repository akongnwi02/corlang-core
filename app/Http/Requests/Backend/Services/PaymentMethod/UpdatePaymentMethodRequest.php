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

class UpdatePaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'commission_id'  => __('validation.attributes.backend.services.method.commission'),
            'name'           => __('validation.attributes.backend.services.method.name'),
            'description_en' => __('validation.attributes.backend.services.method.description_en'),
            'description_fr' => __('validation.attributes.backend.services.method.description_fr'),
        ];
    }
    
    public function rules()
    {
        return [
            'commission_id'  => ['sometimes', 'nullable', Rule::exists('commissions', 'uuid')],
            'name'           => ['required', 'string', 'max:191', Rule::unique('paymentmethods', 'name')->ignore(request()->route('method'), 'uuid')],
            'description_en' => ['required', 'string', 'max:191'],
            'description_fr' => ['required', 'string', 'max:191'],
        ];
    }
}
