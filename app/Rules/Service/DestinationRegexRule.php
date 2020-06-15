<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/12/20
 * Time: 10:19 PM
 */

namespace App\Rules\Service;


use App\Exceptions\Api\BadRequestException;
use App\Models\Service\Service;
use App\Services\Constants\BusinessErrorCodes;
use Illuminate\Contracts\Validation\Rule;

class DestinationRegexRule implements Rule
{
    public $serviceCode;
    
    public $destination;
    
    public function __construct($serviceCode, $destination)
    {
        $this->serviceCode = $serviceCode;
        $this->destination = $destination;
    }
    
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
        $service = Service::where('services.code', $this->serviceCode)->first();
    
        // do the service validation
        if ($service) {
            if ($service->destination_regex) {
                if (preg_match($service->destination_regex, $this->destination)) {
                    return true;
                }
                throw new BadRequestException(BusinessErrorCodes::REGEX_VALIDATION_ERROR, "The service number did not pass the required regex validation");
            }
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
        return 'The service number (destination) did not pass the regular expression validation';
    }
}
