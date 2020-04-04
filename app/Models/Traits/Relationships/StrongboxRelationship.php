<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/3/20
 * Time: 1:30 AM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Company\Company;

trait StrongboxRelationship
{
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'uuid');
    }
}
