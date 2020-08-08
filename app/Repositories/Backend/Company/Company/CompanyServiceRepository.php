<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/6/20
 * Time: 12:36 AM
 */

namespace App\Repositories\Backend\Company\Company;


use App\Events\Backend\Companies\Service\ServiceDeactivated;
use App\Events\Backend\Companies\Service\ServiceReactivated;
use App\Exceptions\GeneralException;

class CompanyServiceRepository
{
    /**
     * @param $company
     * @param $service
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($company, $service, $status)
    {
        $marked = $company->services()->updateExistingPivot($service, ['is_active' => $status]);
    
        if ($marked) {
        
            switch ($status) {
                case 0:
                    event(new ServiceDeactivated($company, $service));
                    break;
            
                case 1:
                    event(new ServiceReactivated($company, $service));
                    break;
            }
            
            return $company->services()->where('services.uuid', $service->uuid)->first()->specific;
            
        }
    
        throw new GeneralException(__('exceptions.backend.companies.service.mark_error'));
    }
    
    /**
     * @param $company
     * @param $service
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function update($company, $service, $data)
    {
        $providercommission_id = request()->has('providercommission_id') ? $data['providercommission_id'] : null;
        $customercommission_id = request()->has('customercommission_id') ? $data['customercommission_id'] : null;
        $commissiondistribution_id = request()->has('commission_distribution_id') ? $data['commission_distribution_id'] : null;
    
        $updated = $company->services()->updateExistingPivot($service, [
            'customercommission_id' => $customercommission_id,
            'providercommission_id' => $providercommission_id,
            'commission_distribution_id' => $commissiondistribution_id,
        ]);
    
        if ($updated) {
            return $company->services()->where('services.uuid', $service->uuid)->first()->specific;
        }
        
        throw new GeneralException(__('exceptions.backend.companies.service.update_error'));
    }
    
    /**
     * @param $company
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function create($company, $data)
    {
        $saved = $company->services()->sync($data);
    
        if ($saved) {
            return $company->services;
        }
    
        throw new GeneralException(__('exceptions.backend.companies.service.update_error'));
    }
}
