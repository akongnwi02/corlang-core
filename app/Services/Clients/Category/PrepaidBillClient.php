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
use App\Http\Resources\Api\Business\PrepaidBillResource;
use App\Models\Service\Category;
use App\Rules\Business\CorrectPinCode;
use App\Rules\Service\ServiceAccessRule;
use App\Services\Business\Models\ModelInterface;
use App\Services\Business\Models\PrepaidBill;
use App\Services\Clients\AbstractCategory;
use App\Services\Constants\BusinessErrorCodes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Log;
use Illuminate\Validation\Rule;

class PrepaidBillClient extends AbstractCategory
{
    public function validate($request)
    {
        validator($request, [
            'destination'   => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'service_code'  => ['required', new ServiceAccessRule(),],
            'amount'        => ['required', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/'],
            'currency_code' => ['required', Rule::exists('currencies', 'code')],
            'phone'         => ['sometimes', 'nullable', 'string', 'min:9'],
//            'pincode'       => ['required', new CorrectPinCode()],

        ])->validate();
    }
    
    /**
     * @param $data
     * @return PrepaidBill
     * @throws ServerErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function quote($data): ModelInterface
    {
        $json = [
            'destination'  => $data['destination'],
            'service_code' => $data['service_code'],
        ];
        
        $httpClient = $this->getHttpClient();
    
        Log::debug("{$this->getCategoryClientName()}: Sending search request to micro service", [
            'json' => $json,
            'host' => $this->url
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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
            'json' => $json,
            'host' => $this->url,
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
     * @throws ServerErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status($transaction): bool
    {
        return $this->statusCheck($this->url, $this->key, $transaction);
    }
    
    public function response(ModelInterface $prepaidBill)
    {
        return new PrepaidBillResource($prepaidBill);
    }
    
    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->httpClient($this->url, $this->key);
    }
    
    public function getCategoryClientName(): string
    {
        return class_basename($this);
    }
}
