<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:11 PM
 */

namespace App\Models\Transaction;

use App\Models\Traits\Attributes\TransactionAttribute;
use App\Models\Traits\Methods\TransactionMethod;
use App\Models\Traits\Relationships\TransactionRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Transaction extends Model
{
    use Uuid,
        TransactionMethod,
        TransactionRelationship,
        TransactionAttribute,
        Userstamps;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_reversed'        => 'boolean',
        'amount'             => 'double',
        'customer_fee'       => 'double',
        'agent_commission'   => 'double',
        'company_commission' => 'double',
        'system_commission'  => 'double',
        'total_commission'   => 'double',
    ];
    
}
