<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:23 PM
 */

namespace App\Services\Business\Validators;

use App\Exceptions\Api\ServerErrorException;
use App\Services\Clients\Category\PrepaidBillClient;
use App\Services\Clients\Category\ReceiveMoneyClient;
use App\Services\Constants\BusinessErrorCodes;

trait CategoryProvider
{
    /**
     * @param $category
     * @return ReceiveMoneyClient|PrepaidBillClient
     * @throws ServerErrorException
     */
    public function category($category)
    {
        switch ($category->code) {
            case config('business.service.category.prepaidbills.code');
                return new PrepaidBillClient($category);
            case config('business.service.category.receivemoney.code'):
                return new ReceiveMoneyClient($category);
            default:
                throw new ServerErrorException(BusinessErrorCodes::UNKNOWN_SERVICE_CATEGORY, "Service category $category->code is not implemented");
        }
    }
}
