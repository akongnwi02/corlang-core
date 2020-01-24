<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:23 PM
 */

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;
use App\Models\Service\Category;
use App\Models\System\Gateway;

trait ServiceRelationship
{
    public function deactivator()
    {
        return $this->hasOne(User::class, 'uuid', 'deactivated_by_id');
    }
    
    public function category()
    {
        return $this->hasOne(Category::class, 'uuid', 'category_id');
    }
    
    public function gateway()
    {
        return $this->hasOne(Gateway::class, 'uuid', 'gateway_id');
    }
}
