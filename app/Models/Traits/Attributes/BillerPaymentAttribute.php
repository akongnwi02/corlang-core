<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/2/20
 * Time: 1:08 AM
 */

namespace App\Models\Traits\Attributes;


use App\Models\System\Currency;

trait BillerPaymentAttribute
{
    public function getAmountLabelAttribute()
    {
        return number_format($this->amount, 2) . ' ' . Currency::where('is_default', true)->first()->code;
    }
}
