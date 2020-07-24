<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/11/20
 * Time: 1:17 AM
 */

namespace App\Http\Resources\Api\Merchant\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantOrderResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'code' => $this->code,
            'external_id' => $this->external_id,
            'total_amount' => $this->total_amount,
            'currency_code' => $this->currency_code,
            'company' => $this->company->name,
            'company_logo' => $this->company->logo_url,
            'company_address' => $this->company->address,
            'company_website' => $this->company->website,
            'user' => $this->user->name,
            'payment_method' => @$this->payment_method->name,
            'completed_at' => $this->completed ? $this->completed_at->toDatetimeString() : null,
            'notification_url' => $this->notification_url,
            'return_url' => $this->return_url,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at->toDatetimeString(),
            'customer' => [
                'name' => $this->customer_name,
                'phone' => $this->customer_phone,
                'email' => $this->customer_email,
                'address' => $this->customer_address,
            ],
            'items' => MerchantItemResource::collection($this->items),
        ];
    }
}
