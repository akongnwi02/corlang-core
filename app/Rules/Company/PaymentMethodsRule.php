<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/26/20
 * Time: 4:02 PM
 */

namespace App\Rules\Company;


use App\Models\Service\PaymentMethod;
use Illuminate\Contracts\Validation\Rule;

class PaymentMethodsRule implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $methodId) {
            if (! PaymentMethod::find($methodId)) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('exceptions.backend.companies.company.invalid_method');
    }
    
}
