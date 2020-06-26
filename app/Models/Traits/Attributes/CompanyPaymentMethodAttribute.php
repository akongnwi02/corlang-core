<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/26/20
 * Time: 2:34 PM
 */

namespace App\Models\Traits\Attributes;


trait CompanyPaymentMethodAttribute
{
    /**
     * @return string
     */
    public function getActiveLabelAttribute()
    {
        if ($this->is_active) {
            if (auth()->user()->canDeactivateCompanyServices()) {
                return '<a href="'.route('admin.companies.company.service.mark', [
                        $this->company_id,
                        $this->service_id,
                        0
                    ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.services.service.deactivate').'" name="confirm_item"><span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span></a>';
            }
            return '<span class="badge badge-success">'.__('labels.general.yes').'</span>';
        }
        
        if (auth()->user()->canDeactivateCompanyServices()) {
            return '<a href="'.route('admin.companies.company.service.mark', [
                    $this->company_id,
                    $this->service_id,
                    1
                ]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.services.service.activate').'" name="confirm_item"><span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span></a>';
        }
        return '<span class="badge badge-danger">'.__('labels.general.no').'</span>';
    }
}
