<?php

namespace App\Models\Auth\Traits\Scope;

use Carbon\Carbon;

/**
 * Class UserScope.
 */
trait UserScope
{
    /**
     * @param $query
     * @param bool $confirmed
     *
     * @return mixed
     */
    public function scopeConfirmed($query, $confirmed = true)
    {
        return $query->where('confirmed', $confirmed);
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('active', $status);
    }

    public function scopeCreatedAtStart($query, $date)
    {
        return $query->where('created_at', '>=', Carbon::parse($date));
    }

    public function scopeCreatedAtEnd($query, $date)
    {
        return $query->where('created_at', '<', Carbon::parse($date)->addDay());
    }
}
