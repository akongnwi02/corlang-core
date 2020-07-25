<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/25/20
 * Time: 3:37 PM
 */

namespace App\Models\Traits\Attributes;


trait MerchantOrderAttribute
{
    public function getStatusClassLabelAttribute()
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
