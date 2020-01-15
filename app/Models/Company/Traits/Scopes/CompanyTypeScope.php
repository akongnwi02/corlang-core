<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/14/20
 * Time: 11:20 PM
 */

namespace App\Models\Company\Traits\Scopes;

/**
 * Trait CompanyTypeScope
 * @package App\Models\Company\Traits\Scopes
 */
trait CompanyTypeScope
{
    public function scopeWithoutCentral($query, $withoutCentral = true)
    {
        if ($withoutCentral) {
            $query->where('name', '!=', config('business.company.type.central'));
        }
    }
}
