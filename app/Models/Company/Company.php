<?php

namespace App\Models\Company;

use App\Models\Traits\Attributes\CompanyAttribute;
use App\Models\Traits\Methods\CompanyMethod;
use App\Models\Traits\Relationships\CompanyRelationship;
use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

/**
 * Class Role.
 */
class Company extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    use CompanyRelationship,
        CompanyScope,
        CompanyAttribute,
        CompanyMethod,
        Uuid,
        SoftDeletes,
        Userstamps;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'country_id',
        'street',
        'state',
        'postal_code',
        'phone',
        'city',
        'website',
        'email',
        'is_active',
        'size',
        'type_id',
        'owner_id',
        'logo_url',
        'direct_polling',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active'      => 'boolean',
        'uuid'           => 'string',
        'direct_polling' => 'boolean',
    ];
}
