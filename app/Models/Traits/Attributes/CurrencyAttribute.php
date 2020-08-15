<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/15/20
 * Time: 12:50 PM
 */

namespace App\Models\Traits\Attributes;


trait CurrencyAttribute
{
    /**
     * @return string
     */
    public function getActiveLabelAttribute()
    {
        if ($this->is_active) {
            if (auth()->user()->can(config('permission.permissions.deactivate_currencies'))) {
                return '<a href="'.route('admin.administration.currency.mark', [
                        $this,
                        0
                    ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.administration.currency.deactivate').'" name="confirm_item"><span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span></a>';
            }
            return '<span class="badge badge-success">'.__('labels.general.yes').'</span>';
        }
        
        if (auth()->user()->can(config('permission.permissions.deactivate_currencies'))) {
            return '<a href="'.route('admin.administration.currency.mark', [
                    $this,
                    1
                ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.administration.currency.activate').'" name="confirm_item"><span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span></a>';
        }
        return '<span class="badge badge-danger">'.__('labels.general.no').'</span>';
    }
    
    /**
     * @return string
     */
    public function getDefaultLabelAttribute()
    {
        if ($this->is_default) {
            return '<i class="fa fa-check"></i>';
        }
        return '<i class="fa fa-times"></i>';
    }
    
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.update_currencies'))) {
            return '<a href="'.route('admin.administration.currency.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
        }
    }
    
    public function getActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.general.actions').'">
		  '.$this->edit_button.'
		</div>';
    }
    
    public function setCodeAttribute($code)
    {
        $this->attributes['code'] = strtoupper($code);
    }
}
