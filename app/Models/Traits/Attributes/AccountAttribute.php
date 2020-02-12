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

trait AccountAttribute
{
    /**
     * @return string
     */
    public function getActiveLabelAttribute()
    {
        if ($this->isActive()) {
            if (auth()->user()->canFreezeAccounts()) {
                return '<a href="'.route('admin.account.mark', [
                    $this,
                        0
                    ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.account.deactivate').'" name="confirm_item"><span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span></a>';
            }
            return '<span class="badge badge-success">'.__('labels.general.yes').'</span>';
        }
        
        if (auth()->user()->canFreezeAccounts()) {
            return '<a href="'.route('admin.account.mark', [
                $this,
                    1
                ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.account.activate').'" name="confirm_item"><span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span></a>';
        }
        return '<span class="badge badge-danger">'.__('labels.general.no').'</span>';
    }
    
    /**
     * @return string
     */
    public function getCreditButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.credit_accounts'))) {
            return '<a href="'.route('admin.services.service.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.account.credit').'" class="btn btn-success"><i class="fas fa-plus-circle"></i></a>';
        }
    }
    
    /**
     * @return string
     */
    public function getDebitButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.debit_accounts'))) {
            return '<a href="'.route('admin.services.service.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.account.debit').'" class="btn btn-danger"><i class="fas fa-minus-circle"></i></a>';
        }
    }
    
    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        if (auth()->user()->can(config('permission.permissions.read_accounts'))) {
            return '<a href="'.route('admin.account.deposit.show', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-primary"><i class="fas fa-eye"></i></a>';
        }
    }
    
    public function getActionButtonsAttribute()
    {
        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.services.service.service_actions').'">
		  '.$this->credit_button.'
		  '.$this->debit_button.'
		  '.$this->show_button.'
		</div>';
    }
    
    public function getAccountBalanceLabelAttribute()
    {
        $movementRepository = new MovementRepository();
        return number_format($movementRepository->getAccountBalance($this,2)) . ' ' . Currency::where('is_default', true)->firstOrFail()->code;
    }
    
    public function getOwnerLabelAttribute()
    {
        if ($this->type->name == config('business.account.type.user')) {
            return $this->user->full_name;
        }
        
        if ($this->type->name == config('business.account.type.company')) {
            return $this->company->name;
        }
        
    }
}
