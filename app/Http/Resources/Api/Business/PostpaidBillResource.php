<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/17/20
 * Time: 1:17 PM
 */

namespace App\Http\Resources\Api\Business;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class PostpaidBillResource extends Resource
{
    public function toArray($request)
    {
        return [
            'uuid'            => $this->transaction_id,
            'bill_number'     => $this->bill_number,
            'contract_number' => $this->contract_number,
            'bill_due_date'   => $this->bill_due_date ? Carbon::parse($this->bill_due_date)->format('d/m/y')  : null,
            'bill_gen_date'   => $this->bill_gen_date ? Carbon::parse($this->bill_due_date)->format('d/m/y')  : null,
            'bill_is_late'    => $this->bill_is_late,
            'service_code'    => $this->service_code,
            'address'         => $this->address,
            'currency_code'   => $this->currency_code,
            'phone'           => $this->phone,
            'name'            => $this->name,
            'bill_is_paid'    => $this->bill_is_paid,
            'type'            => $this->type,
            'amount'             => (float)$this->amount,
            'fee'                => (float)$this->customer_fee,
        ];
    }
}
