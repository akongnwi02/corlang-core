<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/13/20
 * Time: 9:57 PM
 */

namespace App\Rules\Service;


use App\Exceptions\Api\ForbiddenException;
use App\Exceptions\Api\NotFoundException;
use App\Models\Service\PaymentMethod;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Contracts\Validation\Rule;

class PaymentMethodAccessRule implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     * @throws ForbiddenException
     * @throws NotFoundException
     */
    public function passes($attribute, $value)
    {
        $method = PaymentMethod::where('code', $value)->first();
    
        // service should exist
        if (! $method) {
            throw new NotFoundException(BusinessErrorCodes::PAYMENT_METHOD_NOT_FOUND, "Payment method with code $value was not found");
        }
    
        // service is deactivated for everybody
        if (! $method->is_active) {
            throw new ForbiddenException(BusinessErrorCodes::PAYMENT_METHOD_NOT_ACTIVE, "This payment method is not activated for you at the moment");
        }
    
        // payment method should be active for the company
        if (request()->order->company->methods()->where('code', $value)->exists()
            && request()->order->company->methods()->where('code', $value)->first()->specific->is_active) {
            return true;
        }
        throw new ForbiddenException(BusinessErrorCodes::PAYMENT_METHOD_NOT_ACTIVE, "This payment method is not activated for you at the moment");
    }
    
    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'This payment method is not activated for you. Please contact support';
    }
}
