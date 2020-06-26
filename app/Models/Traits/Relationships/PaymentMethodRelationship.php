<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/1/20
 * Time: 12:42 PM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Business\Commission;
use App\Models\Company\Company;
use App\Models\Company\CompanyPaymentMethod;
use App\Models\Service\Service;

trait PaymentMethodRelationship
{
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'uuid');
    }
    
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_paymentmethod', 'paymentmethod_id', 'company_id', 'uuid')
            ->withTimestamps()
            ->using(CompanyPaymentMethod::class)
            ->as('specific')
            ->withPivot([
                'is_active',
                'customercommission_id',
                'providercommission_id',
            ]);
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
