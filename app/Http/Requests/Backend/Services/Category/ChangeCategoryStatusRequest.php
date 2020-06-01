<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/31/20
 * Time: 12:57 PM
 */

namespace App\Http\Requests\Backend\Services\Category;


use Illuminate\Foundation\Http\FormRequest;

class ChangeCategoryStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->company->isDefault();
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
