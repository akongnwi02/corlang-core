<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:23 PM
 */

namespace App\Services\Business\Validators;

use App\Exceptions\Api\ServerErrorException;
use App\Exceptions\GeneralException;
use App\Services\Clients\Category\PrepaidBillClient;
use App\Services\Constants\BusinessErrorCodes;

trait CategoryTrait
{
    /**
     * @param $category
     * @return PrepaidBillClient
     * @throws ServerErrorException
     */
    public function category($category)
    {
        switch ($category->code) {
            case config('business.service.category.prepaidbills.code');
                return new PrepaidBillClient($category);
            default:
                throw new ServerErrorException(BusinessErrorCodes::UNKNOWN_SERVICE_CATEGORY, "Service category $category->code is not implemented");
        }
    }
}
