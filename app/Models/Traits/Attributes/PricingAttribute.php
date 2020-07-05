<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:02 PM
 */

namespace App\Models\Traits\Attributes;


trait PricingAttribute
{
    public function getPercentageLabelAttribute()
    {
        return $this->percentage  . '%';
    }
    
    public function getFromLabelAttribute()
    {
        return number_format($this->from, 2)  . ' ' . $this->commission->currency->code;
    }
    
    public function getToLabelAttribute()
    {
        return number_format($this->to, 2) . ' ' . $this->commission->currency->code;
    }
    
    public function getFixedLabelAttribute()
    {
        return number_format($this->fixed, 2) . ' ' . $this->commission->currency->code;
    }
}
