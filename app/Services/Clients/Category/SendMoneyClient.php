<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 11:01 PM
 */

namespace App\Services\Clients\Category;


use App\Exceptions\Api\BadRequestException;
use App\Http\Resources\Api\Business\ReceiveMoneyResource;
use App\Rules\Service\ServiceAccessRule;
use App\Rules\Service\ServiceAmountRangeRule;
use App\Services\Business\Models\ModelInterface;
use App\Services\Business\Models\ReceiveMoney;
use App\Services\Clients\AbstractCategory;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SendMoneyClient extends AbstractCategory
{
    
    public function validate($request)
    {
        validator($request, [
            'destination'   => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'service_code'  => ['required', new ServiceAccessRule(),],
            'amount'        => ['required', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/', new ServiceAmountRangeRule()],
            'currency_code' => ['required', Rule::exists('currencies', 'code')],
            'auth_payload'  => ['sometimes', 'nullable', 'min:3'],
        ])->validate();
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
    
    public function response(ModelInterface $receiveMoney)
    {
        return new ReceiveMoneyResource($receiveMoney);
    }
}
