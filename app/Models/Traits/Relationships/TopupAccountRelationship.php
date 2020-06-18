<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/18/20
 * Time: 6:08 PM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Service\PaymentMethod;

trait TopupAccountRelationship
{
    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentmethod_id', 'uuid');
    }
}
