<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/8/20
 * Time: 11:55 PM
 */

namespace App\Models\Merchant;


use App\Models\Traits\Relationships\MerchantOrderRelationship;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class MerchantOrder extends Model
{
    use Uuid,
        MerchantOrderRelationship;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchant_orders';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_phone',
        'external_id',
        'total_amount',
        'currency_code',
        'company_id',
        'user_id',
        'code',
        'notification_url',
        'return_url',
        'description',
        'language',
    ];
}
