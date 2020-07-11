<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/11/20
 * Time: 1:23 AM
 */

namespace App\Http\Resources\Api\Merchant\V1;


use Illuminate\Http\Resources\Json\JsonResource;

class MerchantItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'quantity' => $this->quantity,
            'unit_cost' => $this->unit_cost,
            'sub_total' => $this->sub_total,
            'code' => $this->code
        ];
    }
}
