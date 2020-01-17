<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:23 PM
 */

namespace App\Models\Company\Traits\Relationships;

use App\Models\Auth\User;
use App\Models\Company\CompanyType;

trait CompanyRelationship
{
    public function owner()
    {
        return $this->hasOne(User::class, 'uuid', 'owner_id');
    }
    
    public function type()
    {
        return $this->hasOne(CompanyType::class, 'uuid', 'type_id');
    }
}
