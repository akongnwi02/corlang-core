<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:02 PM
 */

namespace App\Models\Traits\Attributes;


trait CompanyAttribute
{
    /**
     * @return string
     */
    public function getActiveLabelAttribute()
    {
        if ($this->isActive()) {
            if (auth()->user()->canDeactivateCompanies()) {
                return '<a href="'.route('admin.companies.company.mark', [
                    $this,
                        0
                    ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.companies.company.deactivate').'" name="confirm_item"><span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span></a>';
            }
            return '<span class="badge badge-success">'.__('labels.general.yes').'</span>';
        }
        
        if (auth()->user()->canDeactivateCompanies()) {
            return '<a href="'.route('admin.companies.company.mark', [
                $this,
                    1
                ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.companies.company.activate').'" name="confirm_item"><span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span></a>';
        }
        return '<span class="badge badge-danger">'.__('labels.general.no').'</span>';
    }
    
    public function getFullLogoAttribute()
    {
        return url($this->logo_url ?: 'img/backend/brand/logo/logo-company-profile.png');
    }
    
    public function getMinimizedLogoAttribute()
    {
        return url($this->logo_url ?: 'img/backend/brand/logo/logo-main.png');
    }
}
