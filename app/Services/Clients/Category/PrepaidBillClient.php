<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:25 PM
 */

namespace App\Services\Clients\Category;

use App\Exceptions\Api\ServerErrorException;
use App\Http\Resources\Api\Business\PrepaidBillResource;
use App\Models\Service\Category;
use App\Rules\Service\ServiceAccessRule;
use App\Services\Business\Models\PrepaidBill;
use App\Services\Clients\CategoryInterface;
use App\Services\Constants\BusinessErrorCodes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
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
            'phone'         => ['required', 'string', 'min:9'],
        ]);
    }
    
    /**
     * @param $data
     * @return PrepaidBill
     * @throws ServerErrorException
     */
    public function quote($data): PrepaidBill
    {
        $httpClient = $this->getHttpClient();
        try {
            $response = $httpClient->request('GET', config('business.service.endpoints.search'), [
                'json' => [
                    'destination'  => $data['destination'],
                    'service_code' => $data['service_code'],
                ]
            ]);
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
        } catch (GuzzleException $exception) {
            throw new ServerErrorException(BusinessErrorCodes::MICRO_SERVICE_CONNECTION_ERROR, 'Error connecting to service: ' . $exception->getMessage());
        }
        $content = $response->getBody()->getContents();
    
        Log::debug('response from connector service', [
            'service' => config('business.service.category.prepaidbills.name'),
            'response' => $content
        ]);
    
        $body = json_decode($content);
        
        if ($response->getStatusCode() == 200) {
            $prepaidBill = new PrepaidBill();
            $prepaidBill->setServiceCode($data['service_code'])
                ->setMeterCode($data['destination'])
                ->setName($body->name)
                ->setAddress($body->address)
                ->setAmount($data['amount'])
                ->setCurrencyCode($data['currency_code'])
                ->setDestination($data['destination'])
                ->setPaymentMethodCode($data['paymentmethod_code'])
                ->setPaymentAccount($data['account']);
            return $prepaidBill;
        } else {
            throw new ServerErrorException($body->error_code, $body->message);
        }
    }
    
    
    public function confirm($data)
    {
        $httpClient = $this->getHttpClient();
        try {
            $response = $httpClient->request('GET', config('business.service.endpoints.search'), [
                'json' => [
                    'destination'  => $data['destination'],
                    'service_code' => $data['service_code'],
                ]
            ]);
        } catch (GuzzleException $exception) {
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
}
