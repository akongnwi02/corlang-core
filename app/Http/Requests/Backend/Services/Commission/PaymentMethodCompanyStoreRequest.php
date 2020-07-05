<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/5/20
 * Time: 7:45 PM
 */

namespace App\Http\Requests\Backend\Services\Commission;


use App\Rules\Service\CompaniesRule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodCompanyStoreRequest extends FormRequest
{
    
    public function authorize()
    {
        return auth()->user()->company->isDefault();
    }
    
    
    public function attributes()
    {
        return [
            'company_ids' => __('validation.attributes.backend.services.method.companies')
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
            'company_ids' => ['sometimes', 'array', new CompaniesRule()]
        ];
    }
}
