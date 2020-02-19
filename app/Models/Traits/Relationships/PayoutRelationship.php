<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/19/20
 * Time: 6:54 PM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Service\Service;

trait PayoutRelationship
{
    public function method()
    {
        return $this->belongsTo(Service::class, 'paymentmethod_id', 'uuid');
    }
}
