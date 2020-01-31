<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/25/20
 * Time: 7:26 PM
 */

namespace App\Http\Requests\Backend\Services\Commission;


use App\Rules\Service\PricingRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommissionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'name'        => __('validation.attributes.backend.services.commission.name'),
            'description' => __('validation.attributes.backend.services.commission.description'),
            'currency_id' => __('validation.attributes.backend.services.commission.currency'),
            'pricings'    => __('validation.attributes.backend.services.commission.pricings'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:191', Rule::unique('commissions', 'name')->ignore(request()->commission, 'uuid')],
            'description' => 'required|string|max:191',
            'currency_id' => ['required', Rule::exists('currencies', 'uuid')],
            'pricings'    => ['required', 'array', new PricingRule(),]
        ];
    }
}
