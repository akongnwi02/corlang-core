<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/5/20
 * Time: 6:26 PM
 */

namespace App\Http\Requests\Backend\Services\Service;


use App\Rules\Service\CompaniesRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceCompanyStoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'company_ids' => __('validation.attributes.backend.services.service.companies')
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
