<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/23/20
 * Time: 6:45 PM
 */

namespace App\Models\Traits\Scopes;


trait PaymentMethodScope
{
    public function scopeActive($query, $active = true)
    {
        return $query->where('is_active', $active);
    }
}
