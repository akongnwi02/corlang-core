<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/19/20
 * Time: 1:59 PM
 */

namespace App\Rules\Company;

use Illuminate\Contracts\Validation\Rule;

class RightCompanyRule implements Rule
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
        return auth()->user()->company->isDefault()
            || auth()->user()->company->uuid == $value;
    }
    
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('auth.unauthorized_company');
    }
}
