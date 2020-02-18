<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 11:08 PM
 */

namespace App\Models\Traits\Attributes;


trait DrainAttribute
{
    public function getAmountLabelAttribute()
    {
        return number_format($this->amount, 2) . ' ' . $this->currency->code;
    }
    
    public function getAccountLabelAttribute()
    {
        return $this->account->user->name . ' | ' . $this->account->code;
    }
}
