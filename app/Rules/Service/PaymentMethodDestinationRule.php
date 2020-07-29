<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/13/20
 * Time: 10:08 PM
 */

namespace App\Rules\Service;


use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\NotFoundException;
use App\Models\Service\PaymentMethod;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Contracts\Validation\Rule;

class PaymentMethodDestinationRule implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     * @throws BadRequestException
     * @throws NotFoundException
     */
    public function passes($attribute, $value)
    {
        $method = PaymentMethod::where('code', request()->input('paymentmethod_code'))->first();
        // do the account number validation validation
        if ($method) {
            if ($method->destination_regex) {
                if (preg_match($method->account_regex, $value)) {
                    return true;
                }
                throw new BadRequestException(BusinessErrorCodes::REGEX_VALIDATION_ERROR, "The account number did not pass the required regex validation");
            }
            return true;
        }
        throw new NotFoundException(BusinessErrorCodes::PAYMENT_METHOD_NOT_FOUND, 'The payment method was not found');
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'The regular expression validation rule did not pass';
    }
}
