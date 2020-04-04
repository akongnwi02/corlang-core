<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/15/20
 * Time: 3:37 PM
 */

namespace App\Repositories\Api\Business;

use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\ForbiddenException;
use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\ServerErrorException;
use App\Models\Transaction\Transaction;
use App\Repositories\Backend\Movement\MovementRepository;
use App\Services\Business\Models\ModelInterface;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Services\Constants\BusinessErrorCodes;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionRepository
{
    public $serviceRepository;
    public $paymentMethodRepository;
    public $commissionRepository;
    public $movementRepository;
    
    public function __construct
    (
        ServiceRepository $serviceRepository,
        PaymentMethodRepository $paymentMethodRepository,
        CommissionRepository $commissionRepository,
        MovementRepository $movementRepository
    )
    {
        $this->serviceRepository       = $serviceRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->commissionRepository    = $commissionRepository;
        $this->movementRepository      = $movementRepository;
        
    }
    
    /**
     * @param $uuid
     * @return mixed
     * @throws NotFoundException
     */
    public function findByUuid($uuid)
    {
        $transaction = Transaction::where('uuid', $uuid)->first();
        
        if ($transaction) {
            return $transaction;
        }
        
        throw new NotFoundException(BusinessErrorCodes::TRANSACTION_NOT_FOUND, 'Transaction does not exist in database');
    }
    
    /**
     * @param ModelInterface $model
     * @return mixed
     * @throws \Throwable
     */
    public function create(ModelInterface $model)
    {
        
        return \DB::transaction(function () use ($model) {
            /*
             * get the service and the payment method
             */
            $service       = $this->serviceRepository->findByCode($model->getServiceCode());
            $paymentMethod = $this->paymentMethodRepository->findByCode($model->getPaymentMethodCode());
            $category      = $service->category;
            
            /*
             * get the commissions
             */
            $customerServiceCommission       = $service->customer_commission;
            $providerServiceCommission       = $service->provider_commission;
            $customerPaymentMethodCommission = $paymentMethod->customer_commission;
            $providerPaymentMethodCommission = $paymentMethod->provider_commission;
            
            /*
             * calculate the fees
             */
            $customerServiceFee       = $this->commissionRepository->calculateFee($customerServiceCommission, $model->getAmount());
            $providerServiceFee       = $this->commissionRepository->calculateFee($providerServiceCommission, $model->getAmount());
            $customerPaymentMethodFee = $this->commissionRepository->calculateFee($customerPaymentMethodCommission, $model->getAmount());
            
            $totalCustomerFee = $customerServiceFee + $customerPaymentMethodFee;
            
            /*
             * calculate the provider payment method fee
             */
            $providerPaymentMethodFee = $this->commissionRepository->calculateFee($providerPaymentMethodCommission, $totalCustomerFee);
            
            $totalFee = $totalCustomerFee + $providerServiceFee + $providerPaymentMethodFee;
            
            /*
             * get the commission rates
             */
            $agent_commission_rate   = $paymentMethod->is_default ? $this->serviceRepository->getAgentServiceRate($service, auth()->user()) : 0;
            $company_commission_rate = $paymentMethod->is_default ? $this->serviceRepository->getCompanyServiceRate($service, auth()->user()->company) : 0;
            
            /*
             * share the commissions
             */
            $company_commission = ($totalFee * $company_commission_rate / 100) * (1 - $agent_commission_rate / 100);
            $agent_commission   = ($totalFee * $company_commission_rate / 100) * ($agent_commission_rate / 100);
            $system_commission  = $totalFee - ($company_commission + $agent_commission);
            
            // Transaction creation
            $transaction = new Transaction();
            
            $transaction->code               = Transaction::generateCode();
            $transaction->items              = $model->getItems();
            $transaction->amount             = $model->getAmount();
            $transaction->user_id            = auth()->user()->uuid;
            $transaction->company_id         = auth()->user()->company_id;
            $transaction->service_code       = $model->getServiceCode();
            $transaction->currency_code      = $model->getCurrencyCode();
            $transaction->destination        = $model->getDestination();
            $transaction->paymentmethod_code = $model->getPaymentMethodCode();
            $transaction->paymentaccount     = $paymentMethod->is_default ? auth()->user()->account->code : $model->getPaymentAccount();
            $transaction->status             = config('business.transaction.status.created');
            
            $transaction->customer_service_fee       = $customerServiceFee;
            $transaction->provider_service_fee       = $providerServiceFee;
            $transaction->customer_paymentmethod_fee = $customerPaymentMethodFee;
            $transaction->provider_paymentmethod_fee = $providerPaymentMethodFee;
            $transaction->total_customer_fee         = $totalCustomerFee;
            $transaction->total_customer_amount      = $model->getAmount() + $totalCustomerFee;
            $transaction->total_fee                  = $totalFee;
            
            $transaction->customer_servicecommission_id       = @$customerServiceCommission->uuid;
            $transaction->provider_servicecommission_id       = @$providerServiceCommission->uuid;
            $transaction->customer_paymentmethodcommission_id = @$customerPaymentMethodCommission->uuid;
            
            $transaction->service_id       = $service->uuid;
            $transaction->paymentmethod_id = $paymentMethod->uuid;
            $transaction->category_id      = $category->uuid;
            $transaction->category_code    = $category->code;
            
            $transaction->agent_commission   = $agent_commission;
            $transaction->company_commission = $company_commission;
            $transaction->system_commission  = $system_commission;
            
            if ($transaction->save()) {
                return $transaction;
            }
            
            throw new ServerErrorException(BusinessErrorCodes::TRANSACTION_CREATION_ERROR);
        });
    }
    
    /**
     * Processes payment for the default payment method.
     * If user's account balance is insufficient,
     * use the company's balance if direct polling is enabled
     *
     * @param $transaction
     * @throws BadRequestException
     * @throws \Throwable
     */
    public function processPayment($transaction)
    {
        // verify if user has sufficient balance
        $userAccount = $transaction->user->account;
        
        if ($userAccount->getBalance() > $transaction->total_customer_amount && $userAccount->is_active) {

            $this->movementRepository->registerSale($userAccount, $transaction);
            
        } else if ($transaction->company->direct_polling && $transaction->company->account->is_active) {
            
            $companyAccount = $transaction->company->account;
            
            if ($companyAccount->getBalance() > $transaction->total_customer_amount) {
                
                $this->movementRepository->registerSale($companyAccount, $transaction);
            }
        } else {
            if (! $userAccount->is_active) {
                throw new ForbiddenException(BusinessErrorCodes::ACCOUNT_LIMITED, 'Your account has been limited.');
            }
            throw new BadRequestException(BusinessErrorCodes::INSUFFICIENT_BALANCE, 'Your account balance is insufficient for this transaction');
        }
    }
    
    public function getAgentTransactions()
    {//create movement
        $transactions = QueryBuilder::for(Transaction::class)
            ->where('user_id', auth()->user()->uuid)
            ->allowedSorts('transactions.created_at', 'transactions.updated_at')
            ->defaultSort('-transactions.created_at', 'transactions.updated_at');
        return $transactions;
    }
    
    public function getAllSales()
    {
        $sales = QueryBuilder::for(Transaction::class)
            ->allowedSorts('transactions.created_at', 'transactions.updated_at')
            ->defaultSort('-transactions.created_at', 'transactions.updated_at');
        
        if (!auth()->user()->company->is_default) {
            $sales->where('company_id', auth()->user()->company_id);
        }
        
        return $sales;
    }
}
