<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/5/20
 * Time: 6:29 PM
 */

namespace App\Rules\Service;


use App\Models\Company\Company;
use Illuminate\Contracts\Validation\Rule;

class CompaniesRule implements Rule
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
        foreach ($value as $companyId) {
            if (! Company::find($companyId)) {
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
        return __('exceptions.backend.services.service.invalid_company');
    }
}
