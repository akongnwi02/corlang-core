<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 12:56 AM
 */

namespace App\Models\Account;


use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Uuid;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
}
