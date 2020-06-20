<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/20/20
 * Time: 12:37 AM
 */

namespace App\Models\Traits\Scopes;


use Carbon\Carbon;

trait TransactionScope
{
    public function scopeStartDate($query, $date)
    {
        return $query->where('created_at', '>=', Carbon::parse($date));
    }
    
    public function scopeEndDate($query, $date)
    {
        return $query->where('created_at', '<', Carbon::parse($date)->addDay());
    }
}
