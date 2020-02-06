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
        $company_rate = request()->has('company_rate') ? $data['company_rate'] : null;
        $agent_rate = request()->has('agent_rate') ? $data['agent_rate'] : null;
    
        $updated = $company->services()->updateExistingPivot($service, [
            'company_rate' => $company_rate,
            'agent_rate' => $agent_rate
        ]);
    
        if ($updated) {
            return $company->services()->where('services.uuid', $service->uuid)->first()->specific;
        }
        
        throw new GeneralException(__('exceptions.backend.companies.service.mark_error'));
    }
}
