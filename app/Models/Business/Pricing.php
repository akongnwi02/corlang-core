<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 10:16 PM
 */

namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pricings';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'commission_id',
        'from',
        'to',
        'fixed',
        'percentage',
    ];
    
    protected $casts = [
        'from' => 'double',
        'to' => 'double',
        'fixed' => 'double',
        'percentage' => 'double',
    ];
}
