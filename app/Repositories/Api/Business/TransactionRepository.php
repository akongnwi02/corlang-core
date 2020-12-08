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
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Repositories\Backend\System\CurrencyRepository;
use App\Services\Business\Models\ModelInterface;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use App\Services\Constants\BusinessErrorCodes;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TransactionRepository
{
    public $serviceRepository;
    public $paymentMethodRepository;
    public $commissionRepository;
    public $movementRepository;
    public $currencyRepository;
    
    public function __construct
    (
        ServiceRepository $serviceRepository,
        CommissionRepository $commissionRepository,
        MovementRepository $movementRepository,
        PaymentMethodRepository $paymentMethodRepository,
        CurrencyRepository $currencyRepository
    )
    {
        $this->serviceRepository    = $serviceRepository;
        $this->commissionRepository = $commissionRepository;
        $this->movementRepository   = $movementRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->currencyRepository = $currencyRepository;
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
            
            // public users should not withdraw money if it is not a top up
            if (! $accountTopUp
                && $service->is_money_withdrawal
                && ! auth()->user()->company_id
            ) {
                throw new ForbiddenException(BusinessErrorCodes::SERVICE_NOT_ALLOWED, 'Users without companies are not allowed to perform cash out');
            }
            
            /*
             * get the commissions
             */
            if ($accountTopUp) {
                $customerServiceCommission = auth()->user()->company ? $this->commissionRepository->getCompanyMethodCustomerCommission($service->payment_method, auth()->user()->company) : $service->payment_method->customer_commission;
                $providerServiceCommission = auth()->user()->company ? $this->commissionRepository->getCompanyMethodProviderCommission($service->payment_method, auth()->user()->company) : $service->payment_method->provider_commission;
            } else {
                $customerServiceCommission = auth()->user()->company ? $this->commissionRepository->getCompanyServiceCustomerCommission($service, auth()->user()->company) : $service->customer_commission;
                $providerServiceCommission = auth()->user()->company ? $this->commissionRepository->getCompanyServiceProviderCommission($service, auth()->user()->company) : $service->provider_commission;
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
            $agent_commission_rate = 0;
            $company_commission_rate = 0;
            $external_commission_rate = 0;
            
            
            if (auth()->user()->company && !$accountTopUp) {
                
                $commission_distribution = @auth()->user()->company->services()->where('uuid', $service->uuid)->first()->specific->commission_distribution ?: @$service->commission_distribution;
    
                if ($commission_distribution) {
                    $agent_commission_rate = $commission_distribution->agent_rate;
                    $company_commission_rate = $commission_distribution->company_rate;
                    $external_commission_rate = $commission_distribution->external_rate;
                }
            }
            
            \Log::debug('The following distribution strategy was applied for this transaction', [
                'agent_rate' => $agent_commission_rate,
                'company_rate' => $company_commission_rate,
                'external_rate' => $external_commission_rate,
            ]);
            
            /*
             * Verify if the commission distribution amongst the stakeholders is not greater than 100
             */
            if (($agent_commission_rate + $company_commission_rate + $external_commission_rate) > 100) {
                dd($agent_commission_rate, $company_commission_rate, $external_commission_rate);
                throw new ServerErrorException(BusinessErrorCodes::COMMISSION_DISTRIBUTION_ERROR, 'The commission for this service is not properly distributed amongst the stakeholders');
            }
            
            /*
             * share the commissions
             */
            $company_commission  = $totalFee * $company_commission_rate / 100;
            $agent_commission    = $totalFee * $agent_commission_rate / 100;
            $external_commission = $totalFee * $external_commission_rate / 100;
            
            $system_commission = $totalFee - ($company_commission + $agent_commission + $external_commission);
    
            \Log::info('Total fee calculated for the service calculated', [
                'service name' => $service->name,
                'service code' => $service->code,
                'destination' => $model->getDestination(),
                'amount' => $model->getAmount(),
                'is top up' => $accountTopUp,
                'provider commission name' => $providerServiceCommission ? $providerServiceCommission->name : null,
                'provider commission id' => $providerServiceCommission? $providerServiceCommission->uuid : null,
                'customer commission name' => $customerServiceCommission ? $customerServiceCommission->name : null,
                'customer commission id' => $customerServiceCommission ? $customerServiceCommission->uuid : null,
                'customer fee' => $customerServiceFee,
                'provider fee' => $providerServiceFee,
                'total fee' => $totalFee,
            ]);
            
            \Log::info('Commissions for the service calculated', [
                'agent name' => auth()->user()->full_name,
                'agent id' => auth()->user()->uuid,
                'company name' => auth()->user()->company_id ? auth()->user()->company->name : null,
                'company id' => auth()->user()->company_id ? auth()->user()->company->uuid : null,
                'company commission rate' => $company_commission_rate,
                'agent commission rate' => $agent_commission_rate,
                'external commission rate' => $external_commission_rate,
                'company commission' => $company_commission,
                'agent commission' => $agent_commission,
                'external commission' => $external_commission,
            ]);
            
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
            
            throw new ServerErrorException(BusinessErrorCodes::TRANSACTION_CREATION_ERROR, 'Error creating transaction');
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
        
        if (($userAccount->getBalance() >= $transaction->total_customer_amount)) {
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
            ->whereNotIn('status', [config('business.transaction.status.created')])
            ->allowedSorts('transactions.created_at', 'transactions.updated_at')
            ->defaultSort('-transactions.created_at', 'transactions.updated_at');
        return $transactions;
    }
    
    public function getAllSales()
    {
        $sales = QueryBuilder::for(Transaction::class)
            ->allowedFilters([
                AllowedFilter::exact('company_id'),
                AllowedFilter::exact('service_id'),
                AllowedFilter::exact('status'),
                AllowedFilter::partial('user.username'),
                AllowedFilter::partial('code'),
                AllowedFilter::scope('start_date'),
                AllowedFilter::scope('end_date'),
            ])
            ->allowedSorts('transactions.created_at', 'transactions.updated_at')
            ->defaultSort('-transactions.created_at', 'transactions.updated_at');
        
        if (!auth()->user()->company->is_default) {
            $sales->where('company_id', auth()->user()->company_id);
        }
        
        return $sales;
    }
    
    public function createTransactionForOrder($order, $data)
    {
        $paymentMethod = $this->paymentMethodRepository->findByCode($data['paymentmethod_code']);
    
        /*
         * Get the applied
         */
        $customerServiceCommission = $this->commissionRepository->getCompanyMethodCustomerCommission($paymentMethod, $order->company);
        $providerServiceCommission = $this->commissionRepository->getCompanyMethodProviderCommission($paymentMethod, $order->company);
        
        /*
         * calculate the fees
         */
        $customerServiceFee = $this->paymentMethodRepository->getCustomerOrderFee($paymentMethod, $order);
        $merchantOrderFee = $this->paymentMethodRepository->getMerchantOrderFee($paymentMethod, $order);
    
        $totalCustomerFee = $customerServiceFee;
        $paymentTotalCustomerFee = $this->currencyRepository->convertAmount($totalCustomerFee, $order->payment_currency_code, true);
    
        /*
         * calculate the provider payment method fee
         */
        $totalFee = $totalCustomerFee + $merchantOrderFee;
        
        
        $transaction = new Transaction;
    
        $transaction->code             = Transaction::generateCode();
        $transaction->items            = $paymentMethod->service->code;
        $transaction->amount           = $order->total_amount;
        $transaction->user_id          = $order->user_id;
        $transaction->company_id       = $order->company_id;
        $transaction->service_code     = $paymentMethod->service->code;
        $transaction->currency_code    = $order->currency_code;
        $transaction->destination      = $data['destination'];
        $transaction->is_account_topup = false;
        $transaction->status           = config('business.transaction.status.created');
    
        $transaction->customer_service_fee  = $customerServiceFee;
        $transaction->provider_service_fee  = $merchantOrderFee;
        $transaction->total_customer_fee    = $totalCustomerFee;
        $transaction->total_customer_amount = $order->total_amount + $totalCustomerFee;
        $transaction->total_fee             = $totalFee;
    
        $transaction->customer_servicecommission_id = @$customerServiceCommission->uuid;
        $transaction->provider_servicecommission_id = @$providerServiceCommission->uuid;
    
        $transaction->service_id    = $paymentMethod->service->uuid;
        $transaction->category_id   = $paymentMethod->service->category->uuid;
        $transaction->category_code = $paymentMethod->service->category->code;
    
        $transaction->agent_commission    = null;
        $transaction->company_commission  = null;
        $transaction->external_commission = null;
        $transaction->system_commission   = null;
    
        $transaction->customer_phone = $order->customer_phone;
    
        
        
        return \DB::transaction(function () use ($order, $transaction, $paymentMethod, $paymentTotalCustomerFee) {
            if ($transaction->save()) {
    
                $order->status = config('business.transaction.status.processing');
                $order->paymentaccount = $transaction->destination;
                $order->paymentmethod = $paymentMethod->name;
                $order->paymentmethod_id = $paymentMethod->uuid;
                $order->customer_fee = $transaction->total_customer_fee;
                $order->payment_customer_fee = $paymentTotalCustomerFee;
                $order->merchant_fee = $transaction->provider_service_fee;
                $order->payment_transaction_id = $transaction->uuid;
                
                if ($order->save()) {
                    return $transaction;
                }
                throw new ServerErrorException(BusinessErrorCodes::TRANSACTION_CREATION_ERROR, 'Error updating order');
            }
            throw new ServerErrorException(BusinessErrorCodes::TRANSACTION_CREATION_ERROR, 'Error creating transaction');
        });
    }
}
