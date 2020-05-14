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
use App\Models\Service\TopupAccount;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentMethodRepository
{
    public function getPaymentMethods()
    {
        return PaymentMethod::orderBy('is_default', 'desc');
    }
    
    public function getPayoutMethods()
    {
        return QueryBuilder::for(PaymentMethod::class)
            ->allowedFilters([AllowedFilter::exact('is_active')])
            ->allowedSorts('paymentmethods.is_active', 'paymentmethods.name')
            ->defaultSort('-paymentmethods.is_active', 'paymentmethods.name');
    }
    
    /**
     * @param $method
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function update($method, $data)
    {
        $method->fill($data);
        $method->is_payment_service = request()->has('is_realtime') ? 1 : 0;
        
        if ($method->save()) {
//            event(new PaymentMethodUpdated($method));
            return $method;
        }
        
        throw new GeneralException(__('exceptions.backend.services.method.update_error'));
    }
    
    /**
     * @param $data
     * @return PaymentMethod
     * @throws GeneralException
     */
    public function create($data)
    {
        $method                     = (new PaymentMethod())->fill($data);
        $method->is_payment_service = request()->has('is_realtime') ? 1 : 0;
        
        if ($method->save()) {
//            event(new PaymentMethodCreated($method));
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
    
    public function findByCode($code)
    {
        return PaymentMethod::where('code', $code)->first();
    }
    
    public function defaultPaymentMethod()
    {
        return PaymentMethod::where('is_default', true)->first();
    }
    
    public function setTopupMethods($user, $topupConfig)
    {
        foreach ($topupConfig as $topupAccount) {
            TopupAccount::updateOrCreate([
                'paymentmethod_id' => $topupAccount['method_id'],
                'user_id' => $user->uuid,
            ],[
                'user_id'          => $user->uuid,
                'paymentmethod_id' => $topupAccount['method_id'],
                'account'          => $topupAccount['account'],
            ]);
        }
    }
}
