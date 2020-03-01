<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 10:12 AM
 */

namespace App\Repositories\Backend\System;


use App\Models\System\Country;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CountryRepository
{

    public function get()
    {
        return QueryBuilder::for(Country::class)
            ->allowedFilters([
                AllowedFilter::exact('is_active'),
                AllowedFilter::exact('is_default'),
            ])
            ->allowedSorts('is_active', 'created_at', 'name')
            ->defaultSort('-is_active', '-is_default', 'name');
    }
}
