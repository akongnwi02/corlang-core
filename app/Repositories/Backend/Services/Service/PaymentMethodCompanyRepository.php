<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/5/20
 * Time: 7:47 PM
 */

namespace App\Repositories\Backend\Services\Service;


use App\Exceptions\GeneralException;

class PaymentMethodCompanyRepository
{
    /**
     * @param $method
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function create($method, $data)
    {
        $saved = $method->companies()->sync($data);
        
        if ($saved) {
            return $method->companies;
        }
        
        throw new GeneralException(__('exceptions.backend.services.method.company_update_error'));
    }
}
