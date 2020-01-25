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
        return $this->percentage*100  . '%';
    }
    
    public function getFromLabelAttribute()
    {
        return $this->from  . ' ' . $this->commission->currency->code;
    }
    
    public function getToLabelAttribute()
    {
        return $this->to . ' ' . $this->commission->currency->code;
    }
    
    public function getFixedLabelAttribute()
    {
        return $this->fixed . ' ' . $this->commission->currency->code;
    }
}
