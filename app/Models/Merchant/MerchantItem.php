<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/8/20
 * Time: 11:55 PM
 */

namespace App\Models\Merchant;


use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class MerchantItem extends Model
{
    use Uuid;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchant_items';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
}
