<?php

namespace App\Rules\Auth;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule as ValidationRule;
/**
 * Class PhoneNumber.
 */
class UniquePhoneNumber implements Rule
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
        $value = substr_replace($value, '237', 0, -9);
        $validator = validator([$attribute => $value], [$attribute =>[ValidationRule::unique('users', 'phone')]]);

        return ! $validator->fails();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.unique');
    }
}
