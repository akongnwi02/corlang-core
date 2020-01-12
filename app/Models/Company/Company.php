<?php

namespace App\Models\Company;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role.
 */
class Company extends Model
{
    use Uuid,
        SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'country',
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
        'user_owner_id',
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
