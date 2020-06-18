<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/10/20
 * Time: 11:30 PM
 */

namespace App\Rules\Service;


use App\Exceptions\Api\ForbiddenException;
use App\Exceptions\Api\NotFoundException;
use App\Models\Service\Service;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Contracts\Validation\Rule;

class ServiceAccessRule implements Rule
{
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     * @throws NotFoundException
     * @throws ForbiddenException
     */
    public function passes($attribute, $value)
    {
        $service = Service::where('services.code', $value)->first();
    
        // service should exist
        if (! $service) {
            throw new NotFoundException(BusinessErrorCodes::SERVICE_NOT_FOUND, "Service with code $value was not found");
        }
        
        // service is deactivated for everybody
        if (! $service->is_active || ! $service->category->is_active) {
            return false;
        }
    
        // service should be active for the company
        if (auth()->user()->company) {
            if (auth()->user()->company->services()->where('services.code', $value)->exists()
                && auth()->user()->company->services()->where('services.code', $value)->first()->specific->is_active) {
                return true;
            }
            
            if ($service->is_money_withdrawal) {
                // there's a hole here
                // we shall not return money withdrawal services to the public bucause
                // but if they send the service, we accept. Especially they want to top up their account
                return true;
            }
            
            throw new ForbiddenException(BusinessErrorCodes::SERVICE_NOT_ALLOWED, 'You are not allowed to use this service at the moment');
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
        return 'This service is not activated for you. Please contact support';
    }
}
