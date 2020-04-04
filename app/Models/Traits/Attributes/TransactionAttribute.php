<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:14 PM
 */

namespace App\Models\Traits\Attributes;


trait TransactionAttribute
{
    public function getClassLabelAttribute()
    {
        if ($this->status == config('business.transaction.status.processing')) {
            return 'info';
        }
        if ($this->status == config('business.transaction.status.success')) {
            return 'success';
        }
        if ($this->status == config('business.transaction.status.failed')) {
            return 'danger';
        }
        if ($this->status == config('business.transaction.status.reversed')) {
            return 'warn';
        }
        
        return 'light';
    }
}
