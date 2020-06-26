<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/26/20
 * Time: 2:43 PM
 */

namespace App\Http\Requests\Backend\Company\Company;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyPaymentMethodUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->company->isDefault()
            || ($this->user()->company == request()->company);
    }
    
    public function attributes()
    {
        return [
            'providercommission_id' => __('validation.attributes.backend.companies.paymentmethod.providercommission'),
            'customercommission_id' => __('validation.attributes.backend.companies.paymentmethod.customercommission'),
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'providercommission_id' => ['nullable', Rule::exists('commissions', 'uuid')],
            'customercommission_id' => ['nullable', Rule::exists('commissions', 'uuid')],
        ];
    }
    
}
