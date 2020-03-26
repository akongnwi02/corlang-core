<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/17/20
 * Time: 1:16 PM
 */

namespace App\Http\Resources\Api\Business;

use Illuminate\Http\Resources\Json\JsonResource;

class PrepaidBillResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid'               => $this->transaction_id,
            'meter_code'         => $this->meter_code,
            'name'               => $this->name,
            'address'            => $this->address,
            'amount'             => (float)$this->amount,
            'service_code'       => $this->service_code,
            'currency_code'      => $this->currency_code,
            'paymentmethod_code' => $this->paymentmethod_code,
            'account'            => $this->account,
            'phone'              => $this->phone,
            'fee'                => (float)$this->customer_fee,
        ];
    }
}
