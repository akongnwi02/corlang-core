<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/9/20
 * Time: 12:08 AM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Auth\User;
use App\Models\Merchant\MerchantItem;

trait MerchantOrderRelationship
{
    public function items()
    {
        return $this->hasMany(MerchantItem::class, 'order_id', 'uuid');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
}
