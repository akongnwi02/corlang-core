<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/24/20
 * Time: 10:15 PM
 */

namespace App\Rules\Service;


use Illuminate\Contracts\Validation\Rule;

class PaymentAccountRule implements Rule
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
    
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'The payment account is invalid';
    }
}
