<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/19/20
 * Time: 1:59 PM
 */

namespace App\Rules\Company;

use Illuminate\Contracts\Validation\Rule;

class UpdateCompanyNameRule implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     * @throws \App\Exceptions\GeneralException
     */
    public function passes($attribute, $value)
    {
        if (request()->company->name !== $value) {
            return auth()->user()->company->isDefault() && auth()->user()->isAdmin();
        }
        
        return true;
    }
    
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('auth.cant_change_company_name');
    }
}
