<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:25 PM
 */

namespace App\Services\Clients\Category;

use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\ServerErrorException;
use App\Exceptions\GeneralException;
use App\Http\Resources\Api\Business\PrepaidBillResource;
use App\Models\Service\Category;
use App\Rules\Service\ServiceAccessRule;
use App\Services\Business\Models\PrepaidBill;
use App\Services\Clients\CategoryInterface;
use App\Services\Constants\BusinessErrorCodes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PrepaidBillClient implements CategoryInterface
{
    public $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    
    public function validate($request)
    {
        validator($request, [
            'destination'   => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'service_code'  => ['required', new ServiceAccessRule(),],
            'amount'        => ['required', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/'],
            'currency_code' => ['required', Rule::exists('currencies', 'code')],
            'reference'     => ['sometimes', 'nullable', 'string', 'min:3'],
            'phone'         => ['sometimes', 'nullable', 'string', 'min:9'],
        ])->validate();
    }
    
    /**
     * @param $data
     * @return PrepaidBill
     * @throws ServerErrorException
     */
    public function quote($data): PrepaidBill
    {
        $json = [
            'destination'  => $data['destination'],
            'service_code' => $data['service_code'],
        ];
        
        $httpClient = $this->getHttpClient();
    
        Log::debug("{$this->getCategoryClientName()}: Sending search request to micro service", [
            'json' => $json,
        ]);
        try {
            $response = $httpClient->request('GET', config('business.service.endpoints.search'), [
                'json' => $json
            ]);
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
        } catch (\Exception $exception) {
            throw new ServerErrorException(BusinessErrorCodes::MICRO_SERVICE_CONNECTION_ERROR, 'Error connecting to service: ' . $exception->getMessage());
        }
        $content = $response->getBody()->getContents();
    
        Log::debug("{$this->getCategoryClientName()}: Response from micro service", [
            'service' => config('business.service.category.prepaidbills.name'),
            'response' => $content
        ]);
    
        $body = json_decode($content);
        
        if ($response->getStatusCode() == 200) {
            $prepaidBill = new PrepaidBill();
            $prepaidBill->setServiceCode($data['service_code'])
                ->setItems($data['service_code'])
                ->setMeterCode($data['destination'])
                ->setName($body->name)
                ->setAddress($body->address)
                ->setAmount($data['amount'])
                ->setCurrencyCode($data['currency_code'])
                ->setPhone($data['phone'])
                ->setDestination($data['destination']);
            return $prepaidBill;
        } else {
            throw new ServerErrorException($body->error_code, $body->message);
        }
    }
    
    /**
     * @param $transaction
     * @throws BadRequestException
     */
    public function confirm($transaction)
    {
        $json = [
            'destination'  => $transaction->destination,
            'service_code' => $transaction->service_code,
            'amount'       => $transaction->amount,
            'external_id'  => $transaction->uuid,
            'phone'        => $transaction->phone,
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
    
    /**
     * @param $transaction
     * @return bool
     * @throws GeneralException
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
            throw new GeneralException(BusinessErrorCodes::GENERAL_CODE, $exception->getMessage());
        }
    }
    
    public function response($prepaidBill)
    {
        return new PrepaidBillResource($prepaidBill);
    }
    
    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client([
            'base_uri'        => config('business.service.category.prepaidbills.api_url'),
            'timeout'         => 120,
            'connect_timeout' => 120,
            'allow_redirects' => true,
            'headers'         => ['x-api-key' => config('business.service.category.prepaidbills.api_key')],
        ]);
    }
    
    public function getCategoryClientName(): string
    {
        return class_basename($this);
    }
}
