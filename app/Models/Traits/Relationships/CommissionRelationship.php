<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:23 PM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Business\Pricing;
use App\Models\System\Currency;

trait CommissionRelationship
{
    public function pricings()
    {
        return $this->hasMany(Pricing::class, 'commission_id', 'uuid');
    }
    
    public function currency()
    {
        return $this->hasOne(Currency::class, 'uuid', 'currency_id');
    }
}
