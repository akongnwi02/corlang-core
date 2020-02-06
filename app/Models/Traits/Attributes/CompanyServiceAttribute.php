<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:02 PM
 */

namespace App\Models\Traits\Attributes;


trait CompanyServiceAttribute
{
    /**
     * @return string
     */
    public function getActiveLabelAttribute()
    {
        if ($this->is_active) {
            if (auth()->user()->canManageCompanyServices()) {
                return '<a href="'.route('admin.companies.company.service.mark', [
                        $this->company_id,
                        $this->service_id,
                        0
                    ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.services.service.deactivate').'" name="confirm_item"><span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span></a>';
            }
            return '<span class="badge badge-success">'.__('labels.general.yes').'</span>';
        }
        
        if (auth()->user()->canManageCompanyServices()) {
            return '<a href="'.route('admin.companies.company.service.mark', [
                    $this->company_id,
                    $this->service_id,
                    1
                ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.services.service.activate').'" name="confirm_item"><span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span></a>';
        }
        return '<span class="badge badge-danger">'.__('labels.general.no').'</span>';
    }
    
    
    public function getAgentRateLabelAttribute()
    {
        return $this->agent_rate . '%';
    }
    
    public function getCompanyRateLabelAttribute()
    {
        return $this->company_rate . '%';
    }

}
