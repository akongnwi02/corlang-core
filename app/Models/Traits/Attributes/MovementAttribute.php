<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:02 PM
 */

namespace App\Models\Traits\Attributes;


use App\Models\System\Currency;
use App\Repositories\Backend\Movement\MovementRepository;

trait MovementAttribute
{
    public function getAmountLabelAttribute()
    {
        return number_format($this->amount, 2) . ' ' . $this->currency->code;
    }
    
    public function getSourceLabelAttribute()
    {
        if ($this->type->name == config('business.movement.type.float'))
            return 'N/A';
    
        if ($this->source->type == config('business.account.type.user'))
            return $this->source->user->full_name . ' | ' . $this->source->code;
        return $this->source->company->name . ' | ' . $this->source->code;
    }
    
    public function getDestinationLabelAttribute()
    {
        if ($this->destination->type == config('business.account.type.user'))
            return $this->destination->user->full_name. ' | ' . $this->destination->code;
        return $this->destination->company->name. ' | ' . $this->destination->code;
    }
}
