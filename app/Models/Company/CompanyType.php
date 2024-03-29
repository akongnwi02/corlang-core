<?php

namespace App\Models\Company;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role.
 */
class CompanyType extends Model
{
    use Uuid;
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companytypes';
    
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
    protected $fillable = [];
}
