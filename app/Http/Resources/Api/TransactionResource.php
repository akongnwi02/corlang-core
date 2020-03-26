<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/26/20
 * Time: 10:50 PM
 */

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid'                  => $this->uuid,
            'code'                  => $this->code,
            'items'                 => $this->items,
            'asset'                 => $this->asset,
            'amount'                => $this->amount,
            'user'                  => $this->user->full_name,
            'company'               => $this->company->name,
            'company_logo'          => $this->company->logo_url,
            'service'               => $this->service->name,
            'service_code'          => $this->service_code,
            'category'              => $this->category->name,
            'category_code'         => $this->category_code,
            'currency_code'         => $this->currency_code,
            'destination'           => $this->destination,
            'paymentmethod'         => $this->method->name,
            'paymentaccount'        => $this->paymentaccount,
            'status'                => $this->status,
            'total_customer_fee'    => (double)$this->total_customer_fee,
            'total_customer_amount' => (double)$this->total_customer_amount,
            'is_reversed'           => $this->is_reversed,
            'created_at'            => $this->created_at->toDatetimeString(),
            'reversed_at'           => $this->reversed_at ? $this->reversed_at->toDatetimeString() : null,
            'completed_at'          => $this->completed_at ? $this->completed_at->toDatetimeString() : null,
        ];
    }
}
