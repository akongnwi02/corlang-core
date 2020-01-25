<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 10:12 AM
 */

namespace App\Repositories\Backend\System;

use App\Models\System\Currency;
use Spatie\QueryBuilder\QueryBuilder;

class CurrencyRepository
{

    public function get()
    {
        $currency = QueryBuilder::for(Currency::class)
            ->allowedSorts('is_active', 'created_at', 'name')
            ->defaultSort('-is_active', '-is_default', 'name')
            ->where('is_default', true);
        return $currency;
    }
}
