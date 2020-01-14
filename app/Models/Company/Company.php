<?php

namespace App\Models\Company;

use App\Models\Company\Traits\Relationships\CompanyRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role.
 */
class Company extends Model
{
    use CompanyRelationship;
    
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
        'deactivated_by_id',
    ];
    
    use Uuid,
        SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active'  => 'boolean',
    ];
}
