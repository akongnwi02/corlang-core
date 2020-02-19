<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/17/20
 * Time: 11:47 PM
 */

namespace App\Models\Traits\Scopes;


trait ServiceScope
{
    public function scopeActive($query, $active = true)
    {
        return $query->where('is_active', $active);
    }
    
    public function scopePaymentMethods($query)
    {
        return $query->where('is_paymentmethod', true);
    }
}
