<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/22/20
 * Time: 8:51 AM
 */

namespace App\Models\System;


use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Uuid;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'value',
        'description',
    ];
}
