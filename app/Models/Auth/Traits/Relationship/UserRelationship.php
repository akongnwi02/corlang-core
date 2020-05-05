<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Account\Account;
use App\Models\Company\Company;
use App\Models\Service\PaymentMethod;
use App\Models\Service\TopupAccount;
use App\Models\System\Session;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\PasswordHistory;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }
    
    /**
     * @return mixed
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'uuid', 'company_id');
    }
    
    public function account()
    {
        return $this->belongsTo(Account::class, 'uuid', 'owner_id');
    }
    
    public function topup_accounts()
    {
        return $this->hasMany(TopupAccount::class, 'user_id', 'uuid');
    }
}
