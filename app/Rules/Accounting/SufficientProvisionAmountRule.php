<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/3/20
 * Time: 11:14 PM
 */

namespace App\Rules\Accounting;


use Illuminate\Contracts\Validation\Rule;

class SufficientProvisionAmountRule implements Rule
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
        return request()->route('service')->getCommissionAmount() >= request()->amount;
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('exceptions.backend.accounting.insufficient_provision_amount');
    }
}
