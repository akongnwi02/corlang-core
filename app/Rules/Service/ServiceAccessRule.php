<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/10/20
 * Time: 11:30 PM
 */

namespace App\Rules\Service;


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
            return auth()->user()->company->services()->where('services.code', $value)->exists()
                && auth()->user()->company->services()->where('services.code', $value)->first()->specific->is_active;
    
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
