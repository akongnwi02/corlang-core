<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 11:00 PM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Account\Account;
use App\Models\Auth\User;
use App\Models\Company\Company;
use App\Models\System\Currency;

trait DrainRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'uuid');
    }
    
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'uuid');
    }
    
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'uuid');
    }
}
