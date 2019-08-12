<?php

namespace App\Rules\Auth;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule as ValidationRule;
/**
 * Class PhoneNumber.
 */
class UniquePhoneOrEmail implements Rule
{
    private $value;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->value = $value;

        if (preg_match('/^(237|00237|\+237)?[6|2|3]{1}\d{8}$/', $this->value)) {
            $this->value = substr_replace($this->value, '237', 0, -9);
            return ! validator([$attribute => $this->value], [$attribute =>[ValidationRule::unique('users', 'phone')]])->fails();
        }

        return ! validator([$attribute => $this->value], [$attribute => [ValidationRule::unique('users', 'email')]])->fails();
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('auth.unique_phone_or_email', ['username' => $this->value]);
    }
}
