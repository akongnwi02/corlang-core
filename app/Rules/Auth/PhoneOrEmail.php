<?php

namespace App\Rules\Auth;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule as ValidationRule;
/**
 * Class PhoneOrEmail
 */
class PhoneOrEmail implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^(237|00237|\+237)?[6|2|3]{1}\d{8}$/', $value) ||

        ! validator([$attribute => $value], [$attribute => 'email'])->fails();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('auth.phone_or_email');
    }
}
