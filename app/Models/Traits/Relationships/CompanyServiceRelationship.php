<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/19/20
 * Time: 8:15 PM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Business\Commission;
use App\Models\Business\CommissionDistribution;

trait CompanyServiceRelationship
{
    public function customer_commission()
    {
        return $this->belongsTo(Commission::class, 'customercommission_id', 'uuid');
    }
    
    public function provider_commission()
    {
        return $this->belongsTo(Commission::class, 'providercommission_id', 'uuid');
    }
    
    public function commission_distribution()
    {
        return $this->belongsTo(CommissionDistribution::class, 'commission_distribution_id', 'uuid');
    }
}
