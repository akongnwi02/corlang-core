<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/31/20
 * Time: 11:23 PM
 */

namespace App\Models\Traits\Attributes;


trait CommissionDistributionAttribute
{
    public function getAgentRateLabelAttribute()
    {
        return $this->agent_rate . '%';
    }
    
    public function getCompanyRateLabelAttribute()
    {
        return $this->company_rate . '%';
    }
    
    public function getExternalRateLabelAttribute()
    {
        return $this->external_rate . '%';
    }
    
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.update_distributions'))) {
            return '<a href="'.route('admin.services.distribution.edit', $this->uuid).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
        }
    }
    
    public function getActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.general.actions').'">
		  '.$this->edit_button.'
		</div>';
    }
}
