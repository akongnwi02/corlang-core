<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:02 PM
 */

namespace App\Models\Traits\Attributes;

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
    
        if ($this->source->type->name == config('business.account.type.user'))
            return $this->source->user->full_name . ' | ' . $this->source->code;
        return $this->source->company->name . ' | ' . $this->source->code;
    }
    
    public function getDestinationLabelAttribute()
    {
        if ($this->destination->type->name == config('business.account.type.user'))
            return $this->destination->user->full_name. ' | ' . $this->destination->code;
        return $this->destination->company->name. ' | ' . $this->destination->code;
    }
    
    public function getClassLabelAttribute()
    {
        if ($this->is_reversed) {
            return 'dark';
        }
        
        if (! $this->is_complete) {
            return 'warning';
        }
        
        if (in_array($this->type->name, [
            config('business.movement.type.deposit'),
            config('business.movement.type.sale'),
            config('business.movement.type.float'),
        ])) {
            return 'success';
        }
        else return 'danger';
    }
}
