<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/29/20
 * Time: 11:24 PM
 */

namespace App\Models\Business;


use App\Models\Traits\Attributes\CommissionDistributionAttribute;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class CommissionDistribution extends Model
{
    use Uuid,
        Userstamps,
        CommissionDistributionAttribute;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'commission_distributions';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'name',
        'description',
        'company_rate',
        'agent_rate',
        'external_rate',
    ];
}
