<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/30/20
 * Time: 11:48 PM
 */

namespace App\Rules\Service;


use App\Exceptions\Api\GeneralErrorException;
use App\Exceptions\GeneralException;
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
            if (
                array_diff(['from', 'to', 'fixed', 'percentage'], array_keys($pricing))
                // make sure the values are positive
                || $pricing['from'] < 0
                || $pricing['to'] < 0
                || $pricing['fixed'] < 0
                // make sure the percentage is a percentage
                || $pricing['percentage'] > 100
                || $pricing['percentage'] < 0
                //make sure from value is less than to
                || $pricing['from'] > $pricing['to']
            ) {
                \Log::error('Invalid pricing', $pricing);
                return false;
            }
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
