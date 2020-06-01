<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/31/20
 * Time: 12:12 PM
 */

namespace App\Http\Requests\Backend\Services\Category;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->company->isDefault();
    }
    
    public function attributes()
    {
        return [
            'name'    => __('validation.attributes.backend.services.category.name'),
            'api_key' => __('validation.attributes.backend.services.category.api_key'),
            'api_url' => __('validation.attributes.backend.services.category.api_url'),
        ];
    }
    
    public function rules()
    {
        return [
            'name'           => ['required', 'string', 'max:191', Rule::unique('categories', 'name')->ignore(request()->route('category'), 'uuid')],
            'api_url'        => ['sometimes', 'nullable', 'url', 'max:191'],
            'api_key'        => ['required', 'string', 'max:191'],
        ];
    }
}
