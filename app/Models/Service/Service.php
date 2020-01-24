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
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Uuid,
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
        'name',
        'category_id',
        'gateway_id',
        'is_active',
        'code',
        'logo_url',
        'providercommission_id',
        'companycommission_id',
        'customercommission_id',
        
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active'  => 'boolean',
    ];
}
