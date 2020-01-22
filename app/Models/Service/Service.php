<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 7:14 PM
 */

namespace App\Models\Service;


use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    
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
        'api_key',
        'api_secret',
        'api_url',
        'is_active',
        'code',
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
