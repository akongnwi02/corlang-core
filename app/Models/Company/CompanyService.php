<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 10:11 PM
 */

namespace App\Models\Company;


use App\Models\Traits\Relationships\CompanyServiceRelationship;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Traits\Attributes\CompanyServiceAttribute;

class CompanyService extends Pivot
{
    use CompanyServiceAttribute,
        CompanyServiceRelationship;
    
    protected $table = 'company_service';
    
    public $incrementing = false;
    
    protected $fillable = [
        'company_id',
        'service_id',
        'is_active',
        'company_rate',
        'agent_rate',
        'external_rate',
        'providercommission_id',
        'customercommission_id',
    ];
    
    protected $casts = [
        'is_active'    => 'boolean',
        'company_rate' => 'double',
        'agent_rate'   => 'double',
    ];
}
