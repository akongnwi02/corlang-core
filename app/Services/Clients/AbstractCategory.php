<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/21/20
 * Time: 10:30 PM
 */

namespace App\Services\Clients;

use App\Exceptions\Api\ServerErrorException;
use App\Services\Business\Models\ModelInterface;
use App\Services\Constants\BusinessErrorCodes;
use GuzzleHttp\Client;
use Log;

abstract class AbstractCategory
{
    public $category;
    
    public $url;
    
    public $key;
    
    public function __construct($category, $config)
    {
        $this->category = $category;
        $this->url = $config['api_url'];
        $this->key = $config['api_key'];
    }
    
    public abstract function validate($request);
    
    public abstract function confirm($transaction);
    
    public abstract function getCategoryClientName(): string;
    
    public abstract function status($transaction): bool;
    
    public abstract function quote($data): ModelInterface;
    
    public abstract function response(ModelInterface $model);
    
    /**
     * @param $url
     * @param $key
     * @return Client
     */
    public function httpClient($url, $key)
    {
        return new Client([
            'base_uri'        => $url,
            'timeout'         => 120,
            'connect_timeout' => 120,
            'allow_redirects' => true,
            'headers'         => ['x-api-key' => $key],
        ]);
    }
    
    /**
     * @param $url
     * @param $key
     * @param $transaction
     * @return bool
     * @throws ServerErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function statusCheck($url, $key, $transaction)
    {
        Log::info("{$this->getCategoryClientName()}: Sending status check request to micro service", [
            'destination'  => $transaction->destination,
            'uuid'         => $transaction->uuid,
            'service_code' => $transaction->service_code,
            'amount'       => $transaction->amount,
            'status'       => $transaction->status,
            'code'         => $transaction->code,
        ]);
    
        $httpClient = $this->httpClient($url, $key);
        try {
            $response = $httpClient->request('GET', config('business.service.endpoints.status')."/$transaction->uuid");
            $content = $response->getBody()->getContents();
            Log::debug("{$this->getCategoryClientName()}: Response from micro service", [
                'destination'  => $transaction->destination,
                'service_code' => $transaction->service_code,
                'code'         => $transaction->code,
                'body'         => json_decode($content),
                'content'      => $content,
            ]);
            return true;
        } catch (\Exception $exception) {
            Log::error("{$this->getCategoryClientName()}: Error Response from micro service", [
                'destination'  => $transaction->destination,
                'service_code' => $transaction->service_code,
                'code'         => $transaction->code,
                'error'        => $exception->getMessage(),
                'exception'    => $exception,
            ]);
            throw new ServerErrorException(BusinessErrorCodes::GENERAL_CODE, $exception->getMessage());
        }
    }
}
