<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/6/20
 * Time: 5:21 PM
 */

namespace App\Http\Requests\Api\Business;

use App\Rules\Service\ServiceAccessRule;
use App\Rules\Service\DestinationRegexRule;
use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
{
    public function authorize()
    {
        if (auth()->user()->company_id) {
            return auth()->user()->company->is_active;
        }
        
        // return true for guests
        return true;
    }
    
    public function rules()
    {
        return [
            'service_code' => ['required', new ServiceAccessRule(),],
            'destination' => [new DestinationRegexRule($this->input('service_code'), $this->input('destination'))]
//            'pincode' => ['required', new CorrectPinCode()],
        ];
    }
}
