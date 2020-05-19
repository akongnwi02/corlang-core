<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:23 PM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Account\Account;
use App\Models\Account\MovementType;
use App\Models\Auth\User;
use App\Models\System\Currency;

trait MovementRelationship
{
    public function type()
    {
        return $this->hasOne(MovementType::class, 'uuid', 'type_id');
    }
    
    public function source()
    {
        return $this->belongsTo(Account::class, 'sourceaccount_id', 'uuid');
    }
    
    public function destination()
    {
        return $this->belongsTo(Account::class, 'destinationaccount_id', 'uuid');
    }
    
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'uuid');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
}
