<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/28/20
 * Time: 12:35 AM
 */

namespace App\Services\Clients\Category;


use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\ServerErrorException;
use App\Http\Resources\Api\Business\PostpaidBillResource;
use App\Rules\Service\ServiceAccessRule;
use App\Services\Business\Models\ModelInterface;
use App\Services\Business\Models\PostpaidBill;
use App\Services\Clients\AbstractCategory;
use App\Services\Constants\BusinessErrorCodes;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Log;

class PostpaidBillClient extends AbstractCategory
{
    public function validate($request)
    {
        Log::info("{$this->getCategoryClientName()}: Validating input data");
        validator($request, [
            'destination'   => ['required', 'string'],
            'service_code'  => ['required', new ServiceAccessRule(),],
            'phone'         => ['sometimes', 'nullable', 'string', 'min:9'],
            'item'          => ['required',],
            //            'pincode'       => ['required', new CorrectPinCode()],
        ])->validate();
        Log::info("{$this->getCategoryClientName()}: Input data valid");
    }
    
    /**
     * @param $transaction
     * @throws BadRequestException
     */
    public function confirm($transaction)
    {
        $json = [
            'destination'  => $transaction->destination,
            'item'         => $transaction->items,
            'service_code' => $transaction->service_code,
            'amount'       => $transaction->amount,
            'external_id'  => $transaction->uuid,
            'phone'        => $transaction->phone,
            'callback_url' => $this->callbackUrl,
        ];
    
        Log::debug("{$this->getCategoryClientName()}: Sending purchase request to micro service", [
            'json' => $json,
            'host' => $this->url,
        ]);
    
        $httpClient = $this->httpClient();
        try {
            $response = $httpClient->request('POST', $this->executeEndpoint, [
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
     * @param $data
     * @return PostpaidBill
     * @throws NotFoundException
     */
    public function quote($data): ModelInterface
    {
        $bills = \Cache::store(config('app.micro_services.cache_store'))->pull($data['destination']);
    
        if (!$bills) {
            throw new NotFoundException(BusinessErrorCodes::BILL_NOT_IN_CACHE, 'The bill is not found in cache. Please search again');
        }
        
        foreach ($bills as $bill) {
            if ($bill->getBillNumber() == $data['item']) {
                return $bill;
            }
        }
    
        throw new NotFoundException(BusinessErrorCodes::BILL_NOT_IN_CACHE, 'The bill is not found in cache. Please search again');
    }
    
    /**
     * @param $data
     * @return array
     * @throws ServerErrorException
     */
    public function search($data)
    {
        $json = [
            'destination'  => $data['destination'],
            'service_code' => $data['service_code'],
        ];
    
        $httpClient = $this->httpClient();
    
        Log::debug("{$this->getCategoryClientName()}: Sending search request to micro service", [
            'json' => $json,
            'host' => $this->url
        ]);
        try {
            $response = $httpClient->request('GET', $this->searchEndpoint, [
                'json' => $json
            ]);
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
        } catch (\Exception $exception) {
            throw new ServerErrorException(BusinessErrorCodes::MICRO_SERVICE_CONNECTION_ERROR, 'Error connecting to service: ' . $exception->getMessage());
        }
        $content = $response->getBody()->getContents();
    
        Log::debug("{$this->getCategoryClientName()}: Response from micro service", [
            'service' => $this->name,
            'response' => $content
        ]);
    
        $body = json_decode($content);
    
        if ($response->getStatusCode() == 200) {
            $results = collect($body);
            
            $bills = [];
            
            foreach ($results as $result) {
                $postpaidBill = new PostpaidBill();
                $postpaidBill->setDestination($result->contract_number)
                    ->setItems($result->bill_number)
                    ->setContractNumber($result->contract_number)
                    ->setBillNumber($result->bill_number)
                    ->setBillDueDate($result->bill_due_date)
                    ->setBillIsLate($result->bill_is_late)
                    ->setAddress($result->address)
                    ->setCurrencyCode($result->currency_code)
                    ->setPhone($result->phone)
                    ->setName($result->name)
                    ->setBillIsPaid($result->bill_is_paid)
                    ->setAmount($result->amount)
                    ->setCustomerFee($result->fee)
                    ->setServiceCode($data['service_code']);
                
                $bills[] = $postpaidBill;
            }
            return $bills;
        } else {
            throw new ServerErrorException($body->error_code, $body->message);
        }
    }
    
    public function getCategoryClientName(): string
    {
        return class_basename($this);
    }
    
    public function response(ModelInterface $model)
    {
        return new PostpaidBillResource($model);
    }
    
    public function resultResponse($result)
    {
        return PostpaidBillResource::collection($result);
    }
}
