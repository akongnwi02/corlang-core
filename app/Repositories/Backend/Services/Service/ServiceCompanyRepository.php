<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/5/20
 * Time: 6:32 PM
 */

namespace App\Repositories\Backend\Services\Service;


use App\Exceptions\GeneralException;

class ServiceCompanyRepository
{
    /**
     * @param $service
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function create($service, $data)
    {
        $saved = $service->companies()->sync($data);
    
        if ($saved) {
            return $service->companies;
        }
    
        throw new GeneralException(__('exceptions.backend.services.company.update_error'));
    }
}
