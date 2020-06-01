<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 1:29 AM
 */

namespace App\Models\Account;


use Illuminate\Database\Eloquent\Model;

class BillerPayment extends Model
{
    
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
