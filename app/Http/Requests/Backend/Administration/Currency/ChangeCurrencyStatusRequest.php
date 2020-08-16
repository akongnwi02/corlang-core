<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/15/20
 * Time: 1:05 PM
 */

namespace App\Http\Requests\Backend\Administration\Currency;


use Illuminate\Foundation\Http\FormRequest;

class ChangeCurrencyStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->company->isDefault()
            && ! request()->currency->is_default;
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
