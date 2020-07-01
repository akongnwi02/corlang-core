<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/1/20
 * Time: 12:21 AM
 */

namespace App\Http\Resources\Api\Business;


use Illuminate\Http\Resources\Json\JsonResource;

class AirtimeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid'               => $this->transaction_id,
            'name'               => $this->name,
            'address'            => $this->address,
            'amount'             => (float)$this->amount,
            'service_code'       => $this->service_code,
            'currency_code'      => $this->currency_code,
            'phone_number'       => $this->phone,
            'fee'                => (float)$this->customer_fee,
        ];
    }
}
