<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/23/20
 * Time: 6:44 PM
 */

namespace App\Repositories\Backend\Services\Service;


use App\Exceptions\GeneralException;
use App\Models\Service\PaymentMethod;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentMethodRepository
{
    public function getPaymentMethods()
    {
        return PaymentMethod::active()
            ->orderBy('is_default', 'desc');
    }
    
    public function getAllPaymentMethods()
    {
        return QueryBuilder::for(PaymentMethod::class)
            ->allowedFilters([AllowedFilter::exact('is_active')])
            ->allowedSorts('paymentmethods.is_active', 'paymentmethods.name')
            ->defaultSort( '-paymentmethods.is_active', 'paymentmethods.name');
    }
    
    /**
     * @param $method
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function update($method, $data)
    {
        $method = $method->update($data);
    
        if ($method) {
            return $method;
        }
        
        throw new GeneralException(__('exceptions.backend.services.method.create_error'));
    }
    
    /**
     * @param $method
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($method, $status)
    {
        $method->is_active = $status;
        
        if ($method->save()) {
        
//            switch ($status) {
//                case 0:
//                    event(new PaymentMethodDeactivated($method));
//                    break;
//
//                case 1:
//                    event(new PaymentMethodReactivated($method));
//                    break;
//            }
            
            return $method;
        }
        
        throw new GeneralException(__('exceptions.backend.services.method.mark_error'));
    }
}
