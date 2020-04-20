<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/6/20
 * Time: 5:21 PM
 */

namespace App\Http\Requests\Api\Business;

use App\Rules\Business\CorrectPinCode;
use App\Rules\Service\ServiceAccessRule;
use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
{
    public function authorize()
    {
        if (auth()->user()->company_id) {
            return auth()->user()->company->is_active;
        }
    }
    
    public function rules()
    {
        return [
            'service_code' => ['required', new ServiceAccessRule(),],
            'pincode' => ['required', new CorrectPinCode()],
        ];
    }
}
