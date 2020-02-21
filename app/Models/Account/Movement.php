<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 12:56 AM
 */

namespace App\Models\Account;

use App\Models\Traits\Attributes\MovementAttribute;
use App\Models\Traits\Methods\MovementMethod;
use App\Models\Traits\Relationships\MovementRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Movement extends Model
{
    use Uuid,
        MovementAttribute,
        MovementRelationship,
        Userstamps,
        MovementMethod;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'movements';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
}
