<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/1/20
 * Time: 12:06 AM
 */

namespace App\Services\Clients\Category;

use App\Exceptions\Api\BadRequestException;
use App\Http\Resources\Api\Business\AirtimeResource;
use App\Rules\Service\ServiceAccessRule;
use App\Rules\Service\ServiceAmountRangeRule;
use App\Services\Business\Models\Airtime;
use App\Services\Business\Models\ModelInterface;
use App\Services\Clients\AbstractCategory;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Validation\Rule;
use Log;

class AirtimeClient extends AbstractCategory
{
    
    public function validate($request)
    {
        Log::info("{$this->getCategoryClientName()}: Validating input data");
        validator($request, [
            'destination'   => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'service_code'  => ['required', new ServiceAccessRule(),],
            'amount'        => ['required', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/', new ServiceAmountRangeRule()],
            'currency_code' => ['required', Rule::exists('currencies', 'code')],
        ])->validate();
    
        if ($this->category->code == config('business.service.category.data.code')) {
            validator($request, [
                'item'   => ['required', Rule::exists('items', 'code')],
            ])->validate();
        }
        
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
            'service_code' => $transaction->service_code,
            'item'         => $transaction->items,
            'amount'       => $transaction->amount,
            'external_id'  => $transaction->uuid,
            'phone'        => $transaction->phone,
            'callback_url' => $this->callbackUrl
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
     * @return string
     */
    public function getCategoryClientName(): string
    {
        return class_basename($this);
    }
    
    /**
     * @param $data
     * @return ModelInterface
     */
    public function quote($data): ModelInterface
    {
        $airtime = new Airtime();
        $airtime->setDestination($data['destination'])
            ->setServiceCode($data['service_code'])
            ->setCurrencyCode($data['currency_code'])
            ->setAmount($data['amount'])
            ->setItems($this->category->code == config('business.service.category.data.code') ? $data['item'] : $data['service_code']);
        
        return $airtime;
    }
    
    /**
     * @param ModelInterface $model
     * @return AirtimeResource
     */
    public function response(ModelInterface $model)
    {
        return new AirtimeResource($model);
    }
}
