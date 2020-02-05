<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 10:11 PM
 */

namespace App\Models\Company;


use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Wildside\Userstamps\Userstamps;

class CompanyService extends Pivot
{
    use Uuid,
        Userstamps;
    
    protected $table = 'company_service';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'company_id',
        'service_id',
        'is_active',
        'company_rate',
        'agent_rate',
    ];
    
    protected $casts = [
        'is_active'    => 'boolean',
        'company_rate' => 'double',
        'agent_rate'   => 'double',
    ];
}
