<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/16/20
 * Time: 7:13 PM
 */

namespace App\Models\Account;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class PayoutType extends Model
{
    use Uuid;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payouttypes';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
}
