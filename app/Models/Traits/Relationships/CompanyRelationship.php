<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:23 PM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Account\Account;
use App\Models\Account\Strongbox;
use App\Models\Auth\User;
use App\Models\Service\PaymentMethod;
use App\Models\System\Country;
use App\Models\Service\Service;
use App\Models\Company\CompanyType;
use App\Models\Company\CompanyService;

trait CompanyRelationship
{
    public function owner()
    {
        return $this->hasOne(User::class, 'uuid', 'owner_id');
    }
    
    public function deactivator()
    {
        return $this->hasOne(User::class, 'uuid', 'deactivated_by_id');
    }
    
    public function type()
    {
        return $this->hasOne(CompanyType::class, 'uuid', 'type_id');
    }
    
    public function country()
    {
        return $this->hasOne(Country::class, 'uuid', 'country_id');
    }
    
    public function services()
    {
        return $this->belongsToMany(Service::class, 'company_service', 'company_id', 'service_id', 'uuid')
            ->withTimestamps()
            ->using(CompanyService::class)
            ->as('specific')
            ->withPivot([
                'is_active',
                'company_rate',
                'agent_rate',
                'external_rate',
                'customercommission_id',
                'providercommission_id',
            ]);
    }
    
    public function methods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'company_paymentmethod', 'company_id', 'paymentmethod_id', 'uuid')
            ->withTimestamps()
            ->using(CompanyService::class)
            ->as('specific')
            ->withPivot([
                'is_active',
                'customercommission_id',
                'providercommission_id',
            ]);
    }
    
    public function users()
    {
        return $this->hasMany(User::class, 'company_id', 'uuid');
    }
    
    public function account()
    {
        return $this->hasOne(Account::class, 'owner_id', 'uuid');
    }
    
    public function strongbox()
    {
        return $this->hasOne(Strongbox::class, 'company_id', 'uuid');
    }
}
