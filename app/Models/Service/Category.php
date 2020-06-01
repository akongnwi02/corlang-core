<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 7:14 PM
 */

namespace App\Models\Service;


use App\Models\Traits\Attributes\CategoryAttribute;
use App\Models\Traits\Relationships\CategoryRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Uuid,
        CategoryAttribute,
        CategoryRelationship;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'name',
        'is_active',
        'code',
        'api_key',
        'api_url',
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
