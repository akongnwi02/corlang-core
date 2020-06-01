<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 1:30 AM
 */

namespace App\Models\Account;


use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class BillerPaymentType extends Model
{
    use Uuid;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'biller_payment_types';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
}
