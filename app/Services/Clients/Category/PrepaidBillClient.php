<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/20/20
 * Time: 9:25 PM
 */

namespace App\Services\Clients\Category;

use App\Http\Resources\Api\Business\PrepaidBillResource;
use App\Models\Service\Category;
use App\Rules\Service\ServiceAccessRule;
use App\Services\Business\Models\PrepaidBill;
use App\Services\Clients\CategoryInterface;
use GuzzleHttp\Client;
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
            'destination'        => ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/'],
            'service_code'       => ['required', new ServiceAccessRule(),],
            'amount'             => ['required', 'nullable', 'regex:/^(?:\d{1,3}(?:,\d{3})+|\d+)(?:\.\d+)?$/'],
            'currency_code'      => ['required', Rule::exists('currencies', 'code')],
            'reference'          => ['sometimes', 'nullable', 'string', 'min:3'],
            'phone'              => ['required', 'string', 'min:9'],
        ]);
    }
    
    public function quote($data): PrepaidBill
    {
    
    }
    
    public function response($transaction)
    {
        return new PrepaidBillResource($transaction);
    }
    
    public function confirm()
    {
        // TODO: Implement confirm() method.
    }
    
    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client([
            'base_uri'        => $this->category->gateway->api_url,
            'timeout'         => 120,
            'connect_timeout' => 120,
            'allow_redirects' => true,
            'headers'         => ['x-api-key' => $this->category->gateway->api_key],
        ]);
    }
}
