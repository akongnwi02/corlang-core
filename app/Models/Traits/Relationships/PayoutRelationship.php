<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/19/20
 * Time: 6:54 PM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Auth\User;
use App\Models\Service\PaymentMethod;

// some methods inherited from DrainRelationship
trait PayoutRelationship
{
    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentmethod_id', 'uuid');
    }
    
    public function decisor()
    {
        return $this->belongsTo(User::class, 'decisor_id', 'uuid');
    }
}
