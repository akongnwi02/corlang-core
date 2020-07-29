<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 7:14 PM
 */

namespace App\Models\Service;


use App\Models\Traits\Attributes\ServiceAttribute;
use App\Models\Traits\Methods\ServiceMethod;
use App\Models\Traits\Relationships\ServiceRelationship;
use App\Models\Traits\Scopes\ServiceScope;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Service extends Model
{
    use Uuid,
        ServiceScope,
        Userstamps,
        ServiceRelationship,
        ServiceMethod,
        ServiceAttribute;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description_en',
        'description_fr',
        'name',
        'destination_placeholder',
        'destination_regex',
        'category_id',
        'is_active',
        'requires_auth',
        'is_money_withdrawal',
        'auth_type',
        'code',
        'providercommission_id',
        'customercommission_id',
        'providercompany_id',
        'commission_distribution_id',
        'company_rate',
        'agent_rate',
        'external_rate',
        'has_items',
        'min_amount',
        'max_amount',
        'step_amount',
    ];
    
    protected $hidden = [
        'providercommission_id',
        'customercommission_id',
        'providercompany_id',
        'company_rate',
        'agent_rate',
        'external_rate',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active'           => 'boolean',
        'customer_rate'       => 'double',
        'agent_rate'          => 'double',
        'external_rate'       => 'double',
        'min_amount'          => 'double',
        'max_amount'          => 'double',
        'step_amount'         => 'double',
        'has_items'           => 'boolean',
        'requires_auth'       => 'boolean',
        'is_money_withdrawal' => 'boolean',
    ];
}
