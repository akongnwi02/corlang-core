<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/13/20
 * Time: 12:29 AM
 */

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PayoutResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid'           => $this->uuid,
            'code'           => $this->code,
            'amount'         => number_format($this->amount, 2),
            'currency_code'  => $this->currency->code,
            'method'         => $this->method->name,
            'account_number' => $this->account_number,
            'account_name'   => $this->account_name,
            'user'           => $this->user->full_name,
            'date'           => $this->created_at->toDatetimeString(),
            'status'         => $this->status,
            'decision_at'    => $this->decision_at,
        ];
    }
}
