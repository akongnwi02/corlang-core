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
        CommissionRepository $commissionRepository,
        MovementRepository $movementRepository
    )
    {
        $this->serviceRepository    = $serviceRepository;
        $this->commissionRepository = $commissionRepository;
        $this->movementRepository   = $movementRepository;
        
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
            // is user trying to top up his account balance ?
            $accountTopUp = false;
            
            /*
             * get the service
             */
            $service  = $this->serviceRepository->findByCode($model->getServiceCode());
            $category = $service->category;
            
            // determine if user is trying to do a topup
            if ($service->is_money_withdrawal && $service->payment_method) {
                
                $topupAccount = @auth()->user()->getTopupAccount($service->payment_method)->account;
                if ($topupAccount == $model->getDestination()) {
                    $accountTopUp = true;
                }
            }
            
            /*
             * get the commissions
             */
            if ($accountTopUp) {
                $customerServiceCommission = $service->payment_method->customer_commission;
                $providerServiceCommission = $service->payment_method->provider_commission;
            } else {
                $customerServiceCommission = auth()->user()->company ? $this->commissionRepository->getCompanyCustomerCommission($service, auth()->user()->company) : $service->customer_commission;
                $providerServiceCommission = auth()->user()->company ? $this->commissionRepository->getCompanyProviderCommission($service, auth()->user()->company) : $service->provider_commission;
            }
            
            /*
             * calculate the fees
             */
            $customerServiceFee = $this->commissionRepository->calculateFee($customerServiceCommission, $model->getAmount());
            $providerServiceFee = $this->commissionRepository->calculateFee($providerServiceCommission, $model->getAmount());
            
            $totalCustomerFee = $customerServiceFee;
            
            /*
             * calculate the provider payment method fee
             */
            $totalFee = $totalCustomerFee + $providerServiceFee;
            
            /*
             * get the commission rates
             */
            $agent_commission_rate    = auth()->user()->company && !$accountTopUp ? $this->serviceRepository->getAgentServiceRate($service, auth()->user()->company) : 0;
            $company_commission_rate  = auth()->user()->company && !$accountTopUp ? $this->serviceRepository->getCompanyServiceRate($service, auth()->user()->company) : 0;
            $external_commission_rate = auth()->user()->company && !$accountTopUp ? $this->serviceRepository->getExternalServiceRate($service, auth()->user()->company) : 0;
            
            /*
             * Verify if the commission distribution amongst the stakeholders is not greater than 100
             */
            if (($agent_commission_rate + $company_commission_rate + $external_commission_rate) > 100) {
                throw new ServerErrorException(BusinessErrorCodes::COMMISSION_DISTRIBUTION_ERROR, 'The commission for this service is not properly distributed amongst the stakeholders');
            }
            
            /*
             * share the commissions
             */
            $company_commission  = $totalFee * $company_commission_rate;
            $agent_commission    = $totalFee * $agent_commission_rate;
            $external_commission = $totalFee * $external_commission_rate;
            
            $system_commission = $totalFee - ($company_commission + $agent_commission + $external_commission);
            
            // Transaction creation
            $transaction = new Transaction();
            
            $transaction->code             = Transaction::generateCode();
            $transaction->items            = $model->getItems();
            $transaction->amount           = $model->getAmount();
            $transaction->user_id          = auth()->user()->uuid;
            $transaction->company_id       = auth()->user()->company_id;
            $transaction->service_code     = $model->getServiceCode();
            $transaction->currency_code    = $model->getCurrencyCode();
            $transaction->destination      = $model->getDestination();
            $transaction->is_account_topup = $accountTopUp;
            $transaction->status           = config('business.transaction.status.created');
            
            $transaction->customer_service_fee  = $customerServiceFee;
            $transaction->provider_service_fee  = $providerServiceFee;
            $transaction->total_customer_fee    = $totalCustomerFee;
            $transaction->total_customer_amount = $model->getAmount() + $totalCustomerFee;
            $transaction->total_fee             = $totalFee;
            
            $transaction->customer_servicecommission_id = @$customerServiceCommission->uuid;
            $transaction->provider_servicecommission_id = @$providerServiceCommission->uuid;
            
            $transaction->service_id    = $service->uuid;
            $transaction->category_id   = $category->uuid;
            $transaction->category_code = $category->code;
            
            $transaction->agent_commission    = $agent_commission;
            $transaction->company_commission  = $company_commission;
            $transaction->external_commission = $external_commission;
            $transaction->system_commission   = $system_commission;
            
            $transaction->customer_phone = @$model->getPhone();
            
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
     * @return boolean
     */
    public function processPayment($transaction)
    {
        // verify if user has sufficient balance
        $userAccount = $transaction->user->account;
        
        if (!$userAccount->is_active) {
            throw new ForbiddenException(BusinessErrorCodes::ACCOUNT_LIMITED, 'Your account has been limited.');
        }
        if ($transaction->service->is_money_withdrawal) {
            $this->movementRepository->registerSale($userAccount, $transaction);
            return true;
        }
        
        if (($userAccount->getBalance() > $transaction->total_customer_amount)) {
            $this->movementRepository->registerSale($userAccount, $transaction);
            return true;
            
        } elseif (
            $transaction->company->direct_polling
            && $transaction->company->account->is_active
            && $transaction->company->account->getBalance() > $transaction->total_customer_amount
        ) {
            $companyAccount = $transaction->company->account;
            
            $this->movementRepository->registerSale($companyAccount, $transaction);
            return true;
        } else {
            throw new BadRequestException(BusinessErrorCodes::INSUFFICIENT_ACCOUNT_BALANCE, 'Your account balance is insufficient for this transaction');
        }
    }
    
    public function getAgentTransactions()
    {
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
