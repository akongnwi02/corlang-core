<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/17/20
 * Time: 11:47 PM
 */

namespace App\Models\Traits\Scopes;


trait PayoutScope
{
    public function scopePending($query)
    {
        return $query->where('status', config('business.payout.status.pending'));
    }
}
