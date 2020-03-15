<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 7:14 PM
 */

namespace App\Models\Service;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Item extends Model
{
    use Uuid,
        Userstamps;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'is_active',
        'name',
        'description',
        'code',
        'amount',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
