<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/26/20
 * Time: 10:50 PM
 */

namespace App\Http\Resources\Api;

use App\Models\Company\Company;
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
            'amount'                => number_format((double)$this->amount, 2),
            'user'                  => $this->user->full_name,
            'company'               => $this->company ? $this->company->name : null,
            'company_logo'          => $this->company ? $this->company->logo_url : Company::where('is_default', true)->first()->logo_url,
            'service_logo'          => $this->service->logo_url,
            'service'               => $this->service->name,
            'service_code'          => $this->service_code,
            'category'              => $this->category->name,
            'category_code'         => $this->category_code,
            'currency_code'         => $this->currency_code,
            'destination'           => $this->destination,
            'paymentaccount'        => $this->paymentaccount,
            'agent_commission'      => $this->agent_commission,
            'status'                => $this->status,
            'error_code'            => $this->error_code,
            'total_customer_fee'    => number_format((double)$this->total_customer_fee, 2),
            'total_customer_amount' => number_format((double)$this->total_customer_amount, 2),
            'created_at'            => $this->created_at->toDatetimeString(),
            'reversed_at'           => $this->reversed_at ? $this->reversed_at->toDatetimeString() : null,
            'completed_at'          => $this->completed_at,
        ];
    }
}
