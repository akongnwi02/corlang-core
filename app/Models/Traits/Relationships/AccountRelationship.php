<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:23 PM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Account\Account;
use App\Models\Account\AccountType;
use App\Models\Account\Movement;
use App\Models\Account\Payout;
use App\Models\Auth\User;
use App\Models\Company\Company;
use App\Models\System\Country;
use App\Models\Service\Service;
use App\Models\Company\CompanyType;
use App\Models\Company\CompanyService;

trait AccountRelationship
{
    public function company()
    {
        return $this->belongsTo(Company::class, 'owner_id', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'uuid');
    }
    
    public function type()
    {
        return $this->hasOne(AccountType::class, 'uuid', 'type_id');
    }
    
    public function payouts()
    {
        return $this->hasMany(Payout::class, 'account_id', 'uuid');
    }
}
