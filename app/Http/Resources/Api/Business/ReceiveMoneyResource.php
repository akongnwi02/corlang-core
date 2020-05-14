<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/14/20
 * Time: 12:35 AM
 */

namespace App\Http\Resources\Api\Business;


use Illuminate\Http\Resources\Json\JsonResource;

class ReceiveMoneyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid'               => $this->transaction_id,
            'source account'     => $this->source_account,
            'name'               => $this->name,
            'address'            => $this->address,
            'amount'             => (float)$this->amount,
            'service_code'       => $this->service_code,
            'currency_code'      => $this->currency_code,
            'phone'              => $this->phone,
            'fee'                => (float)$this->customer_fee,
        ];
    }
}
