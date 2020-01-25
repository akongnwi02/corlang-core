<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:23 PM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Business\Commission;

trait PricingRelationship
{
    public function commission()
    {
        return $this->belongsTo(Commission::class, 'commission_id', 'uuid');
    }
}
