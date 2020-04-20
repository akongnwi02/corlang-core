<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/18/20
 * Time: 1:08 AM
 */

namespace App\Rules\Business;



use App\Exceptions\Api\ForbiddenException;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Contracts\Validation\Rule;

class CorrectPinCode implements Rule
{
    /**
     * @param $attribute
     * @param $value
     * @return bool
     * @throws ForbiddenException
     */
    public function passes($attribute, $value)
    {
        if ($value == auth()->user()->pincode) {
            return true;
        }
        throw new ForbiddenException(BusinessErrorCodes::INCORRECT_PIN_CODE, 'Incorrect pin code');
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'Invalid Pin Code';
    }
}
