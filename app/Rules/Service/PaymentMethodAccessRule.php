<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/10/20
 * Time: 11:30 PM
 */

namespace App\Rules\Service;


use App\Exceptions\Api\NotFoundException;
use App\Models\Service\PaymentMethod;
use App\Models\Service\Service;
use Illuminate\Contracts\Validation\Rule;

class PaymentMethodAccessRule implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     * @throws NotFoundException
     */
    public function passes($attribute, $value)
    {
        $method = PaymentMethod::where('code', $value)->first();
        
        // service should exist
        if (! $method) {
            throw new NotFoundException($attribute, $value);
        }
        
        // service is deactivated for everybody
        if (! $method->is_active) {
            return false;
        }
    
        if ($method->is_default) {
            return auth()->user()->company()->exists();
        }

        return true;
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
