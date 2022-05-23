<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:23 PM
 */

namespace App\Services\Clients;

use App\Exceptions\Api\ServerErrorException;
use App\Services\Clients\Category\AirtimeClient;
use App\Services\Clients\Category\PrepaidBillClient;
use App\Services\Clients\Category\PostpaidBillClient;
use App\Services\Clients\Category\ReceiveMoneyClient;
use App\Services\Clients\Category\SendMoneyClient;
use App\Services\Constants\BusinessErrorCodes;

trait CategoryProvider
{
    /**
     * @param $category
     * @param array $config
     * @return AbstractCategory
     * @throws ServerErrorException
     */
    public function category($category, $config = [])
    {
        $config = $this->getDefaultConfig($config);

        $config['api_url'] = $category->api_url;
        $config['api_key'] = $category->api_key;
        $config['name']    = $category->name;

        switch ($category->code) {
            case config('business.service.category.prepaidbills.code'):
                return new PrepaidBillClient($category, $config);
            case config('business.service.category.receivemoney.code'):
                return new ReceiveMoneyClient($category, $config);
            case config('business.service.category.postpaidbills.code'):
                return new PostpaidBillClient($category, $config);
            case config('business.service.category.sendmoney.code'):
                return new SendMoneyClient($category, $config);
            case config('business.service.category.airtime.code'):
                return new AirtimeClient($category, $config);
            case config('business.service.category.data.code'):
                return new AirtimeClient($category, $config);
            default:
                throw new ServerErrorException(BusinessErrorCodes::UNKNOWN_SERVICE_CATEGORY, "Service category $category->code is not implemented");
        }
    }

    public function getDefaultConfig($config = [])
    {
        return array_merge([
            'callback_url'     => config('app.micro_services.callback_url'),
            'status_endpoint'  => config('business.service.endpoints.status'),
            'execute_endpoint' => config('business.service.endpoints.execute'),
            'search_endpoint'  => config('business.service.endpoints.search'),
            'balance_endpoint'  => config('business.service.endpoints.balance'),
        ], $config);
    }
}
