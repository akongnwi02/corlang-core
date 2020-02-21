<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 5:32 PM
 */

namespace App\Rules\Account;

use Illuminate\Contracts\Validation\Rule;

class SufficientDrainAmountRule implements Rule
{
    public function passes($attribute, $value)
    {

        return request()->account->getUmbrellaBalance() >= request()->amount;
    
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('exceptions.backend.account.insufficient_drain');
    }
}
