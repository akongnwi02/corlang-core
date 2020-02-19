<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 5:18 PM
 */

namespace App\Models\Account;


use App\Models\Traits\Attributes\DrainAttribute;
use App\Models\Traits\Attributes\PayoutAttribute;
use App\Models\Traits\Methods\PayoutMethod;
use App\Models\Traits\Relationships\DrainRelationship;
use App\Models\Traits\Scopes\PayoutScope;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    
    use Uuid,
        DrainRelationship,
        DrainAttribute,
        PayoutScope,
        PayoutAttribute,
        PayoutMethod;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payouts';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
}
