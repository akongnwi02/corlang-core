<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/1/20
 * Time: 12:42 PM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Business\Commission;
use App\Models\Service\Service;

trait PaymentMethodRelationship
{
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'uuid');
    }
    
    public function customer_commission()
    {
        return $this->belongsTo(Commission::class, 'customercommission_id', 'uuid');
    }
    
    public function provider_commission()
    {
        return $this->belongsTo(Commission::class, 'providercommission_id', 'uuid');
    }
}
