<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/9/20
 * Time: 12:15 AM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Merchant\MerchantOrder;

trait MerchantItemRelationship
{
    public function order()
    {
        return $this->belongsTo(MerchantOrder::class, 'order_id', 'uuid');
    }
}
