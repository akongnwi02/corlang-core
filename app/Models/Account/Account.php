<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 12:56 AM
 */

namespace App\Models\Account;


use App\Models\Traits\Methods\AccountMethod;
use App\Models\Traits\Relationships\AccountRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Uuid,
        AccountRelationship,
        AccountMethod;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'owner_id',
        'type_id',
        'code',
    ];
    
}
