<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 5/2/20
 * Time: 12:07 AM
 */

namespace App\Models\Service;


use App\Models\Traits\Relationships\TopupAccountRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class TopupAccount extends Model
{
    use Uuid,
        TopupAccountRelationship,
        Userstamps;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'topup_accounts';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'user_id',
        'paymentmethod_id',
        'account',
        'is_confirmed',
    ];
}
