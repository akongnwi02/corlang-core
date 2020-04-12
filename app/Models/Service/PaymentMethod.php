<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/23/20
 * Time: 6:40 PM
 */

namespace App\Models\Service;

use App\Models\Traits\Attributes\PaymentMethodAttribute;
use App\Models\Traits\Relationships\PaymentMethodRelationship;
use App\Models\Traits\Scopes\PaymentMethodScope;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use Uuid,
        PaymentMethodAttribute,
        PaymentMethodRelationship,
        PaymentMethodScope;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paymentmethods';
    
    protected $primaryKey = 'uuid';
    
    protected $keyType = 'string';
    
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'description_en',
        'description_fr',
        'customercommission_id',
        'providercommission_id',
        'service_id',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active'     => 'boolean',
        'is_default'    => 'boolean',
        'has_reference' => 'boolean',
    ];
    
}
