<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 10:12 AM
 */

namespace App\Repositories\Backend\System;


use App\Models\System\Country;
use App\Models\System\Gateway;
use Spatie\QueryBuilder\QueryBuilder;

class GatewayRepository
{

    public function get()
    {
        return QueryBuilder::for(Gateway::class)
            ->allowedSorts('created_at', 'name')
            ->defaultSort('created_at', 'name');
    }
}
