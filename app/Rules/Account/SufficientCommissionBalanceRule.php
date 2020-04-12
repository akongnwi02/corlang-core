<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/19/20
 * Time: 6:21 PM
 */

namespace App\Rules\Account;

use Illuminate\Contracts\Validation\Rule;

class SufficientCommissionBalanceRule implements Rule
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
        return request()->account->getCommissionBalance() >= request()->amount
            && request()->account->getBalance() > 0;
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('exceptions.backend.account.insufficient_commission');
    }
}
