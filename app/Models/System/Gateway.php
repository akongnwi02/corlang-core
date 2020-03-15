<?php

namespace App\Models\System;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * package App.
 */
class Gateway extends Model
{
    use Uuid;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gateways';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'code',
        'api_key',
        'api_url',
    ];
}
