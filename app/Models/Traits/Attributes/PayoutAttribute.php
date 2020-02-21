<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:02 PM
 */

namespace App\Models\Traits\Attributes;

trait PayoutAttribute
{
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case config('business.payout.status.rejected'):
                return '<span class="badge badge-danger">'.__($this->status).'</span>';
                
            case config('business.payout.status.approved'):
                return '<span class="badge badge-success">'.__($this->status).'</span>';
                
            case config('business.payout.status.cancelled'):
                return '<span class="badge badge-warning">'.__($this->status).'</span>';
                
            case config('business.payout.status.pending'):
                return '<span class="badge badge-info">'.__($this->status).'</span>';
        }
    }
    
}
