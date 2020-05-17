<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/17/20
 * Time: 11:14 PM
 */

namespace App\Services\Clients\Category;


use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\ServerErrorException;
use App\Http\Resources\Api\Business\ReceiveMoneyResource;
use App\Models\Service\Category;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Rules\Service\ServiceAccessRule;
use App\Services\Business\Models\ReceiveMoney;
use App\Services\Clients\CategoryInterface;
use App\Services\Constants\BusinessErrorCodes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Validation\Rule;
use Log;

class ReceiveMoneyClient implements CategoryInterface
{
    public $category;
    public $serviceRepository;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->serviceRepository = new ServiceRepository;
    }
    
    /**
     * @param $request
     * @throws BadRequestException
     * @throws ServerErrorException
     */
    public function validate($request)
    {
        validator($request, [
            'destination'   => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'service_code'  => ['required', new ServiceAccessRule(),],
            'amount'        => ['required', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/'],
            'currency_code' => ['required', Rule::exists('currencies', 'code')],
            'auth_payload'  => ['sometimes', 'nullable', 'string', 'min:3'],
        ])->validate();
    
        $service = $this->serviceRepository->findByCode($request['service_code']);
        
        // verify if the auth field has been provided
        if ($service->requires_auth) {
            if (empty($request['auth_payload'])) {
                throw new BadRequestException(BusinessErrorCodes::CUSTOMER_PAYMENT_AUTH_ERROR, 'The payment authorization token was not provided by the customer');
            }
        }
    
        if (!$service->is_money_withdrawal) {
            throw new ServerErrorException(BusinessErrorCodes::SERVICE_MAL_CONFIGURED, 'Service misconfigured. is_money_withdrawal flag must be set to true');
        }
    }
    
    public function response($receiveMoney)
    {
        return new ReceiveMoneyResource($receiveMoney);
    }
    
    /**
     * @param $data
     * @return ReceiveMoney
     */
    public function quote($data): ReceiveMoney
    {
        $receiveMoney = new ReceiveMoney;
        $receiveMoney->setDestination($data['destination'])
            ->setServiceCode($data['service_code'])
            ->setCurrencyCode($data['currency_code'])
            ->setAmount($data['amount']);
        return $receiveMoney;
    }
    
    /**
     * @param $transaction
     * @param null $otp
     * @throws BadRequestException
     */
    public function confirm($transaction, $otp = null)
    {
        $json = [
            'destination'  => $transaction->destination,
            'service_code' => $transaction->service_code,
            'amount'       => $transaction->amount,
            'external_id'  => $transaction->uuid,
            'otp'          => $otp,
            'callback_url' => config('app.micro_services.callback_url')
        ];
    
        Log::debug("{$this->getCategoryClientName()}: Sending purchase request to micro service", [
            'json' => $json
        ]);
    
        $httpClient = $this->getHttpClient();
        try {
            $response = $httpClient->request('POST', config('business.service.endpoints.execute'), [
                'json' => $json
            ]);
            $content = $response->getBody()->getContents();
        
            Log::info("{$this->getCategoryClientName()}: Purchase request sent successfully to micro service", [
                "body" => json_decode($content),
                "response" => $content,
            ]);
        
        } catch (ClientException $exception) {
            $content = $exception->getResponse()->getBody()->getContents();
            $body = json_decode($content);
            Log::error("{$this->getCategoryClientName()}: Purchase request failed with client errors", [
                'body' => $body,
                'response' => $content,
            ]);
            throw new BadRequestException($body->error_code, $body->message);
        }
    }
    
    public function getCategoryClientName(): string
    {
        return class_basename($this);
    }
    
    /**
     * @param $transaction
     * @return bool
     * @throws ServerErrorException
     */
    public function status($transaction): bool
    {
        Log::info("{$this->getCategoryClientName()}: Sending status check request to micro service", [
            'destination'  => $transaction->destination,
            'uuid'         => $transaction->uuid,
            'service_code' => $transaction->service_code,
            'amount'       => $transaction->amount,
            'status'       => $transaction->status,
            'code'         => $transaction->code,
        ]);
    
        $httpClient = $this->getHttpClient();
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
    
    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client([
            'base_uri'        => config('business.service.category.receivemoney.api_url'),
            'timeout'         => 120,
            'connect_timeout' => 120,
            'allow_redirects' => true,
            'headers'         => ['x-api-key' => config('business.service.category.receivemoney.api_key')],
        ]);
    }
}
