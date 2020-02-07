<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/6/20
 * Time: 11:51 PM
 */

namespace App\Http\Requests\Backend\Company\Company;


use App\Rules\Company\ServicesRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyServiceStoreRequest extends FormRequest
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
            'service_ids' => ['sometimes', 'array', new ServicesRule()]
        ];
    }
}
