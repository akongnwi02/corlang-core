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
    
    public $callbackUrl;
    
    public $statusEndpoint;
    
    public $executeEndpoint;
    
    public $searchEndpoint;
    
    public $name;
    
    public function __construct($category, $config)
    {
        $this->category        = $category;
        $this->url             = $config['api_url'];
        $this->key             = $config['api_key'];
        $this->callbackUrl     = $config['callback_url'];
        $this->statusEndpoint  = $config['status_endpoint'];
        $this->executeEndpoint = $config['execute_endpoint'];
        $this->searchEndpoint  = $config['search_endpoint'];
        $this->name  = $config['name'];
    }
    
    public abstract function validate($request);
    
    public abstract function confirm($transaction);
    
    public abstract function getCategoryClientName(): string;
    
    public abstract function quote($data): ModelInterface;
    
    public abstract function response(ModelInterface $model);
    
    /**
     * @return Client
     */
    public function httpClient()
    {
        return new Client([
            'base_uri'        => $this->url,
            'timeout'         => 120,
            'connect_timeout' => 120,
            'allow_redirects' => true,
            'headers'         => ['x-api-key' => $this->key],
        ]);
    }
    
    /**
     * @param $transaction
     * @return bool
     * @throws ServerErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status($transaction)
    {
        Log::info("{$this->getCategoryClientName()}: Sending status check request to micro service", [
            'destination'  => $transaction->destination,
            'uuid'         => $transaction->uuid,
            'service_code' => $transaction->service_code,
            'amount'       => $transaction->amount,
            'status'       => $transaction->status,
            'code'         => $transaction->code,
        ]);
        
        $httpClient = $this->httpClient();
        try {
            $response = $httpClient->request('GET', $this->statusEndpoint . "/$transaction->uuid");
            $content  = $response->getBody()->getContents();
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
