<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/1/20
 * Time: 11:55 AM
 */

namespace App\Models\Traits\Relationships;


use App\Models\Service\Service;

trait CategoryRelationship
{
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id', 'uuid');
    }
}
