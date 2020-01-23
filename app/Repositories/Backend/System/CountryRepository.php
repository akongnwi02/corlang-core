<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 10:12 AM
 */

namespace App\Repositories\Backend\System;


use App\Models\System\Country;
use Spatie\QueryBuilder\QueryBuilder;

class CountryRepository
{

    public function get()
    {
        return QueryBuilder::for(Country::class)
            ->allowedSorts('is_active', 'created_at', 'name')
            ->defaultSort('-is_active', '-is_default', 'name');
    }
}
