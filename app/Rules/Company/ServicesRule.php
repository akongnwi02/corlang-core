<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/19/20
 * Time: 1:59 PM
 */

namespace App\Rules\Company;

use App\Models\Service\Service;
use Illuminate\Contracts\Validation\Rule;

class ServicesRule implements Rule
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
        foreach ($value as $serviceId) {
            if (! Service::find($serviceId)) {
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
        return __('exceptions.backend.companies.company.invalid_service');
    }
}
