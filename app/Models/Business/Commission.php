<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 10:16 PM
 */

namespace App\Models\Business;


use App\Models\Traits\Attributes\CommissionAttribute;
use App\Models\Traits\Relationships\CommissionRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use Uuid,
        CommissionAttribute,
        CommissionRelationship;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'commissions';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'name',
        'description',
        'currency_id',
    ];

}
