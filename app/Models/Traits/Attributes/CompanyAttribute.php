<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:02 PM
 */

namespace App\Models\Traits\Attributes;

use App\Models\System\Currency;

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
        return url($this->getCompanyLogo() ?: 'img/backend/brand/logo/logo-company-profile.png');
    }
    
    public function getCompanyLogo()
    {
        if ($this->logo_url) {
            return 'storage/'. $this->logo_url;
        }
        return false;
    }
    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
//        if (auth()->user()->can(config('permission.permissions.read_companies'))) {
//            return '<a href="'.route('admin.companies.company.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
//        }
    }
    
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.update_companies'))) {
            return '<a href="'.route('admin.companies.company.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
        }
    }
    
    public function getLoginButtonAttribute()
    {
        /*
 * If the admin is currently NOT spoofing a user
 */
        if (auth()->user()->isAdmin() && auth()->user()->company->isDefault()) {
            //Won't break, but don't let them login to their company
            if (auth()->user()->company_id != $this->uuid ) {
                return '<a href="'.route(
                        'admin.companies.company.login',
                        $this
                    ).'" class="dropdown-item">'.__('buttons.backend.companies.company.login').'</a>';
            }
        }
    
        return '';
    }
    
    public function getActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.companies.company.company_actions').'">
		  '.$this->show_button.'
		  '.$this->edit_button.'
		  <div class="btn-group btn-group-sm" role="group">
			<button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  '.__('labels.general.more').'
			</button>
			<div class="dropdown-menu" aria-labelledby="userActions">
			  '.$this->login_button.'
			</div>
		  </div>
		</div>';
    }
    
    public function getCompanyCommissionBalanceLabelAttribute()
    {
        return number_format($this->getCompanyCommissionBalance(), 2) . ' ' . Currency::where('is_default', true)->first()->code;
    }
    
    public function getCompanyTodayCommissionLabelAttribute()
    {
        return number_format($this->getCompanyTodayCommission(), 2) . ' ' . Currency::where('is_default', true)->first()->code;
    }
    
    public function getCompanyStrongboxBalanceLabelAttribute()
    {
        return number_format($this->strongbox->balance, 2) . ' ' . Currency::where('is_default', true)->first()->code;
    }
}
