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
        if ($this->account->type->name == config('business.account.type.user')) {
            return $this->account->user->name . ' | ' . $this->account->code;
        }
        return $this->account->company->name . ' | ' . $this->account->code;
    }
}
