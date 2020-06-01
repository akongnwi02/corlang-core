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
use App\Rules\Service\ServiceAmountRangeRule;
use App\Services\Business\Models\ModelInterface;
use App\Services\Business\Models\ReceiveMoney;
use App\Services\Clients\AbstractCategory;
use App\Services\Constants\BusinessErrorCodes;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Validation\Rule;
use Log;

class ReceiveMoneyClient extends AbstractCategory
{
    public $serviceRepository;
    
    public function __construct(Category $category, $config)
    {
        $this->serviceRepository = new ServiceRepository;

        return parent::__construct($category, $config);
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
            'amount'        => ['required', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/', new ServiceAmountRangeRule()],
            'currency_code' => ['required', Rule::exists('currencies', 'code')],
            'auth_payload'  => ['sometimes', 'nullable', 'min:3'],
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
    
    public function response(ModelInterface $receiveMoney)
    {
        return new ReceiveMoneyResource($receiveMoney);
    }
    
    /**
     * @param $data
     * @return ReceiveMoney
     */
    public function quote($data): ModelInterface
    {
            $receiveMoney = new ReceiveMoney;
            $receiveMoney->setDestination($data['destination'])
                ->setServiceCode($data['service_code'])
                ->setCurrencyCode($data['currency_code'])
                ->setAmount($data['amount'])
                ->setItems($data['auth_payload']);
            return $receiveMoney;
    }
    
    /**
     * @param $transaction
     * @throws BadRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function confirm($transaction)
    {
        $json = [
            'destination'  => $transaction->destination,
            'service_code' => $transaction->service_code,
            'amount'       => $transaction->total_customer_amount,
            'external_id'  => $transaction->uuid,
            'auth_payload' => $transaction->items,
            'callback_url' => $this->callbackUrl
        ];
    
        Log::debug("{$this->getCategoryClientName()}: Sending purchase request to micro service", [
            'json' => $json,
            'host' => $this->url,
        ]);
    
        $httpClient = $this->httpClient();
        try {
            $response = $httpClient->request('POST', $this->executeEndpoint, [
                'json' => $json,
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
}
