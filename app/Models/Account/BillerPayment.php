<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 1:29 AM
 */

namespace App\Models\Account;


use App\Models\Traits\Attributes\BillerPaymentAttribute;
use App\Models\Traits\Methods\BillerPaymentMethod;
use App\Models\Traits\Relationships\BillerPaymentRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class BillerPayment extends Model
{
    use Uuid,
        Userstamps,
        BillerPaymentMethod,
        BillerPaymentRelationship,
        BillerPaymentAttribute;
        
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'biller_payments';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
}
