<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/26/20
 * Time: 2:34 PM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Business\Commission;

trait CompanyPaymentMethodRelationship
{
    public function customer_commission()
    {
        return $this->belongsTo(Commission::class, 'customercommission_id', 'uuid');
    }
    
    public function provider_commission()
    {
        return $this->belongsTo(Commission::class, 'providercommission_id', 'uuid');
    }
}
