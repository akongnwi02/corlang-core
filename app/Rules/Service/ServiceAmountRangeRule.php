<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 10:44 PM
 */

namespace App\Rules\Service;


use App\Exceptions\Api\BadRequestException;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Contracts\Validation\Rule;

class ServiceAmountRangeRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     * @throws BadRequestException
     */
    public function passes($attribute, $value)
    {
        $serviceRepository = new ServiceRepository();
        
        $service = $serviceRepository->findByCode(request()->service_code);
    
        if ($value < $service->min_amount) {
            throw new BadRequestException(BusinessErrorCodes::MINIMUM_AMOUNT_ERROR, 'The amount is less than the minimum amount required');
        }
        if ($value > $service->max_amount) {
            throw new BadRequestException(BusinessErrorCodes::MAXIMUM_AMOUNT_ERROR, 'The amount is greater than the maximum amount required');
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
    
    }
}
