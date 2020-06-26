<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/26/20
 * Time: 2:43 PM
 */

namespace App\Repositories\Backend\Company\Company;


use App\Exceptions\GeneralException;

class CompanyPaymentMethodRepository
{
    /**
     * @param $company
     * @param $service
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($company, $method, $status)
    {
        $marked = $company->methods()->updateExistingPivot($method, ['is_active' => $status]);
        
        if ($marked) {
            
            switch ($status) {
                case 0:
//                    event(new PaymentMethodDeactivated($company, $service));
                    break;
                
                case 1:
//                    event(new PaymentMethodReactivated($company, $service));
                    break;
            }
            
            return $company->methods()->where('paymentmethods.uuid', $method->uuid)->first()->specific;
            
        }
        
        throw new GeneralException(__('exceptions.backend.companies.method.mark_error'));
    }
    
    /**
     * @param $company
     * @param $service
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function update($company, $method, $data)
    {
        $providercommission_id = request()->has('providercommission_id') ? $data['providercommission_id'] : null;
        $customercommission_id = request()->has('customercommission_id') ? $data['customercommission_id'] : null;
    
        $updated = $company->methods()->updateExistingPivot($method, [
            'customercommission_id' => $customercommission_id,
            'providercommission_id' => $providercommission_id,
        ]);
        
        if ($updated) {
            return $company->methods()->where('paymentmethods.uuid', $method->uuid)->first()->specific;
        }
        
        throw new GeneralException(__('exceptions.backend.companies.method.update_error'));
    }
    
    /**
     * @param $company
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function create($company, $data)
    {
        $saved = $company->methods()->sync($data);
        
        if ($saved) {
            return $company->methods;
        }
        
        throw new GeneralException(__('exceptions.backend.companies.method.update_error'));
        
    }
}
