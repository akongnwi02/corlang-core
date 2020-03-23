<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:37 PM
 */

namespace App\Repositories\Api\Business;

use App\Exceptions\GeneralException;
use App\Models\Transaction\Transaction;
use App\Services\Business\Models\ModelInterface;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;

class TransactionRepository
{
    public $serviceRepository;
    public $paymentMethodRepository;
    public $commissionRepository;
    
    public function __construct
    (
        ServiceRepository $serviceRepository,
        PaymentMethodRepository $paymentMethodRepository,
        CommissionRepository $commissionRepository
    )
    {
        $this->serviceRepository       = $serviceRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->commissionRepository    = $commissionRepository;
    }
    
    /**
     * @param ModelInterface $model
     * @return mixed
     * @throws \Throwable
     */
    public function create(ModelInterface $model)
    {
        
        return \DB::transaction(function () use ($model) {
            
            $service       = $this->serviceRepository->findByCode($model->getServiceCode());
            $paymentMethod = $this->paymentMethodRepository->findByCode($model->getPaymentMethodCode());
            
            // commission settings
            $customerCommission      = $service->customer_commission;
            $providerCommission      = $service->provider_commission;
            $paymentMethodCommission = $paymentMethod->commission;
            
            // fees calculation
            $customerServiceFee = $this->commissionRepository->calculateFee($customerCommission, $model->getAmount());
            $providerFee        = $this->commissionRepository->calculateFee($providerCommission, $model->getAmount());
            $paymentMethodFee   = $this->commissionRepository->calculateFee($paymentMethodCommission, $model->getAmount());
            $totalCustomerFee   = $customerServiceFee + $paymentMethodFee;
            $totalFee           = $totalCustomerFee + $providerFee;
            $sharableFee        = $totalFee - $paymentMethodFee;
            
            // commission gained
            $agent_commission_rate   = $paymentMethod->is_default ? $this->serviceRepository->getAgentServiceRate($service, auth()->user()) : 0;
            $company_commission_rate = $paymentMethod->is_default ? $this->serviceRepository->getCompanyServiceRate($service, auth()->user()) : 0;
            
            $company_commission = ($sharableFee * $company_commission_rate / 100) * (1 - $agent_commission_rate / 100);
            $agent_commission   = ($sharableFee * $company_commission_rate / 100) * ($agent_commission_rate / 100);
            $system_commission  = $totalFee - ($company_commission + $agent_commission);
            
            $transaction = new Transaction();
            
            $transaction->code               = Transaction::generateCode();
            $transaction->items              = $model->getItems();
            $transaction->amount             = $model->getAmount();
            $transaction->user_id            = auth()->user()->id;
            $transaction->company_id         = auth()->user()->company_id;
            $transaction->service_code       = $model->getServiceCode();
            $transaction->currency_code      = $model->getCurrencyCode();
            $transaction->destination        = $model->getDestination();
            $transaction->paymentmethod_code = $model->getPaymentMethodCode();
            $transaction->paymentaccount     = $model->getPaymentAccount();
            $transaction->status             = config('business.transaction.status.created');
            
            $transaction->customer_service_fee = $customerServiceFee;
            $transaction->provider_fee         = $providerFee;
            $transaction->paymentmethod_fee    = $paymentMethodFee;
            $transaction->total_customer_fee   = $totalCustomerFee;
            $transaction->total_fee            = $totalFee;
            
            $transaction->customercommission_id      = $customerCommission->uuid;
            $transaction->providercommission_id      = $providerCommission->uuid;
            $transaction->paymentmethodcommission_id = $paymentMethodCommission->uuid;
            
            $transaction->agent_commission   = $agent_commission;
            $transaction->company_commission = $company_commission;
            $transaction->system_commission  = $system_commission;
            
            if ($transaction->save()) {
                return $transaction;
            }
            
            throw new GeneralException('Error creating transaction database record');
        });
    }
}
