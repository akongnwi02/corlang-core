<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:02 PM
 */

namespace App\Models\Traits\Attributes;


trait ServiceAttribute
{
    /**
     * @return string
     */
    public function getActiveLabelAttribute()
    {
        if ($this->isActive()) {
            if (auth()->user()->canDeactivateServices()) {
                return '<a href="'.route('admin.services.service.mark', [
                    $this,
                        0
                    ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.services.service.deactivate').'" name="confirm_item"><span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span></a>';
            }
            return '<span class="badge badge-success">'.__('labels.general.yes').'</span>';
        }
        
        if (auth()->user()->canDeactivateServices()) {
            return '<a href="'.route('admin.services.service.mark', [
                $this,
                    1
                ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.services.service.activate').'" name="confirm_item"><span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span></a>';
        }
        return '<span class="badge badge-danger">'.__('labels.general.no').'</span>';
    }
    
    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.read_services'))) {
            return '<a href="'.route('admin.services.service.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
        }
    }
    
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.update_services'))) {
            return '<a href="'.route('admin.services.service.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
        }
    }
    
    
    public function getActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.services.service.service_actions').'">
		  '.$this->show_button.'
		  '.$this->edit_button.'
		</div>';
    }
    
}
