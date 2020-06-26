<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/26/20
 * Time: 2:44 PM
 */

namespace App\Http\Requests\Backend\Company\Company;


use App\Rules\Company\PaymentMethodsRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyPaymentMethodStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->company->isDefault()
            || ($this->user()->company == request()->company);
    }
    
    public function attributes()
    {
        return [
            'service_ids' => __('validation.attributes.backend.companies.service.services')
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
            'service_ids' => ['sometimes', 'array', new PaymentMethodsRule()]
        ];
    }
    
}
