<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/17/20
 * Time: 11:47 PM
 */

namespace App\Models\Company\Traits\Scopes;


trait CompanyScope
{
    public function scopeActive($query, $active = true)
    {
        return $query->where('is_active', $active);
    }
}
