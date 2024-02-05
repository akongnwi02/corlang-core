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
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use JD\Cloudder\Facades\Cloudder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentMethodRepository
{
    public $commissionRepository;
    
    public function __construct(CommissionRepository $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }
    
    public function getPaymentMethods()
    {
        return PaymentMethod::orderBy('is_default', 'desc');
    }

    public function getPayoutMethods($allowedFilters = true)
    {
        $methods = QueryBuilder::for(PaymentMethod::class);

        if ($allowedFilters) {
            $methods->allowedFilters([AllowedFilter::exact('is_active')]);
        }
        
        $methods->allowedSorts('paymentmethods.is_active', 'paymentmethods.name')
            ->defaultSort('-paymentmethods.is_active', 'paymentmethods.name');
        return $methods;
    }
    
    /**
     * @param $method
     * @param $data
     * @return mixed
     * @throws GeneralException
     */
    public function update($method, $data, $logo = null)
    {
        $method->fill($data);
        $method->is_realtime = request()->has('is_realtime') ? 1 : 0;
    
        if ($logo) {
            $uploaded = Cloudder::upload($logo);
        
            if ($uploaded) {
                $method->logo_url = Cloudder::secureShow(Cloudder::getPublicId());
            }
        }
        
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
    public function create($data, $logo = null)
    {
        $method = (new PaymentMethod())->fill($data);
        $method->is_realtime = request()->has('is_realtime') ? 1 : 0;
    
        if ($logo) {
            $uploaded = Cloudder::upload($logo);
            if ($uploaded) {
                $method->logo_url = Cloudder::secureShow(Cloudder::getPublicId());
            }
        }
        
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
    
    /**
     * @param $user
     * @param $topupConfig
     * @throws GeneralException
     */
    public function setTopupMethods($user, $topupConfig)
    {
        foreach ($topupConfig as $topupAccount) {
            //make sure this topup configuration is not yet confirmed
            $paymentMethod = $this->findById($topupAccount['method_id']);
            $userTopupAccount = $user->getTopupAccount($paymentMethod);
    
            if (isset($userTopupAccount) && $userTopupAccount->is_confirmed) {
                if (isset($topupAccount['account']) &&  $topupAccount['account'] != $userTopupAccount->account) {
                    throw new GeneralException(__('exceptions.backend.services.topup.update_error', ['method' => $userTopupAccount->method->name]));
                }
                continue;
            }
            
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
    
    public function confirmTopupMethod($user, $paymentMethod)
    {
        $userTopupAccount = $user->getTopupAccount($paymentMethod);
        if ($userTopupAccount->is_confirmed) {
            return true;
        }
        
        $userTopupAccount->is_confirmed = true;
        
        if ($userTopupAccount->save()) {
            return true;
        }
        return false;
    }
    
    public function findById($id)
    {
        return PaymentMethod::where('uuid', $id)->first();
    }
    
    public function getCustomerOrderFee($method, $order)
    {
    
        $customerServiceCommission = $this->commissionRepository->getCompanyMethodCustomerCommission($method, $order->company);
    
        /*
         * calculate the customer fees for each method
         */
        return $this->commissionRepository->calculateFee($customerServiceCommission, $order->total_amount);
        
    }
    
    public function getMerchantOrderFee($method, $order)
    {
    
        $merchantServiceCommission = $this->commissionRepository->getCompanyMethodProviderCommission($method, $order->company);
    
        /*
         * calculate the merchant fees for each method
         */
        return $this->commissionRepository->calculateFee($merchantServiceCommission, $order->total_amount);
        
    }
}
