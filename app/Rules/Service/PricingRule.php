<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/30/20
 * Time: 11:48 PM
 */

namespace App\Rules\Service;

use Illuminate\Contracts\Validation\Rule;

class PricingRule implements Rule
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
        // make sure all the keys are present in each array
        foreach ($value as $pricing) {
            validator($pricing, [
                'from'       => ['required', 'numeric', 'min:0'],
                'to'         => ['required', 'numeric', 'min:0'],
                'fixed'      => ['required', 'numeric'],
                'percentage' => ['required', 'numeric', 'min:-100', 'max:100']
            ])->validate();
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
        return __('exceptions.backend.services.commission.invalid_pricings');
    }
}
