<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/1/20
 * Time: 12:42 PM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Service\Service;

trait PaymentMethodRelationship
{
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'uuid');
    }
}