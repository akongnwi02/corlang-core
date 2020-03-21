<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/21/20
 * Time: 11:46 AM
 */

namespace App\Models\Traits\Attributes;


trait PaymentMethodAttribute
{
    /**
     * @return string
     */
    public function getLogoLabelAttribute()
    {
        if ($this->is_default) {
            return "<img class='navbar-brand-full img-fluid' src='/img/backend/brand/logo/logo-company-profile.png' width='30' height='30' style='border-radius: 50%' alt='$this->name'>";
        } else {
            return $this->service->logo_label;
        }
    }
    
    public function getServiceNameAttribute()
    {
        if ($this->is_default) {
            return config('business.system.service.name');
        } else {
            return $this->service->name;
        }
    }
    
    /**
     * @return string
     */
    public function getActiveLabelAttribute()
    {
        if ($this->is_active) {
            if (auth()->user()->canDeactivatePaymentMethods()) {
                return '<a href="'.route('admin.services.method.mark', [
                        $this,
                        0
                    ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.services.method.deactivate').'" name="confirm_item"><span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span></a>';
            }
            return '<span class="badge badge-success">'.__('labels.general.yes').'</span>';
        }
        
        if (auth()->user()->canDeactivatePaymentMethods()) {
            return '<a href="'.route('admin.services.method.mark', [
                    $this,
                    1
                ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.services.method.activate').'" name="confirm_item"><span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span></a>';
        }
        return '<span class="badge badge-danger">'.__('labels.general.no').'</span>';
    }

    public function getEditButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.update_payment_methods'))) {
            return '<a href="'.route('admin.services.method.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
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
