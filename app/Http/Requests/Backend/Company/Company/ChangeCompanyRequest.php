<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/14/20
 * Time: 4:09 PM
 */

namespace App\Http\Requests\Backend\Company\Company;


use Illuminate\Foundation\Http\FormRequest;

class ChangeCompanyRequest extends FormRequest
{
    public function authorize()
    {
        if (request()->company->isDefault()) {
            return auth()->user()->isAdmin() && auth()->user()->isTemporalLoggedToCompany();
        }
    
        return auth()->user()->isAdmin() && auth()->user()->company->isDefault();
    }
    
    public function rules()
    {
        return [];
    }
}
