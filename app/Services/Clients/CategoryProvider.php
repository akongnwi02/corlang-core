<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:23 PM
 */

namespace App\Services\Business\Validators;

use App\Exceptions\Api\ServerErrorException;
use App\Services\Clients\AbstractCategory;
use App\Services\Clients\Category\PrepaidBillClient;
use App\Services\Clients\Category\PostpaidBillClient;
use App\Services\Clients\Category\ReceiveMoneyClient;
use App\Services\Constants\BusinessErrorCodes;

trait CategoryProvider
{
    /**
     * @param $category
     * @return AbstractCategory
     * @throws ServerErrorException
     */
    public function category($category)
    {
        switch ($category->code) {
            case config('business.service.category.prepaidbills.code'):
                $config['api_url'] = config('business.service.category.prepaidbills.api_url');
                $config['api_key'] = config('business.service.category.prepaidbills.api_key');
                return new PrepaidBillClient($category, $config);
            case config('business.service.category.receivemoney.code'):
                $config['api_url'] = config('business.service.category.receivemoney.api_url');
                $config['api_key'] = config('business.service.category.receivemoney.api_key');
                return new ReceiveMoneyClient($category, $config);
            case config('business.service.category.postpaidbills.code'):
                $config['api_url'] = config('business.service.category.postpaidbills.api_url');
                $config['api_key'] = config('business.service.category.postpaidbills.api_key');
                return new PostpaidBillClient($category, $config);
            default:
                throw new ServerErrorException(BusinessErrorCodes::UNKNOWN_SERVICE_CATEGORY, "Service category $category->code is not implemented");
        }
    }
}
