<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 8:15 PM
 */

namespace App\Repositories\Backend\Account;

use App\Events\Backend\Account\AccountDeactivated;
use App\Events\Backend\Account\AccountReactivated;
use App\Exceptions\GeneralException;
use App\Models\Account\Account;
use App\Models\Account\Payout;
use App\Models\Account\PayoutType;
use App\Models\Filters\Account\FiltersOwner;
use App\Models\Transaction\Transaction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AccountRepository
{
    /**
     * @param $account
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($account, $status)
    {
        $account->is_active = $status;
    
        if ($account->save()) {
        
            switch ($status) {
                case 0:
                    event(new AccountDeactivated($account));
                    break;
            
                case 1:
                    event(new AccountReactivated($account));
                    break;
            }
        
            return $account;
        }
    
        throw new GeneralException(__('exceptions.backend.account.mark_error'));
    }
    
    public function getAllAccounts()
    {
        $accounts = QueryBuilder::for(Account::class)
            ->allowedFilters([
                AllowedFilter::partial('code'),
                AllowedFilter::scope('is_active'),
                AllowedFilter::scope('type_id'),
                AllowedFilter::custom('owner', new FiltersOwner()),

            ])
            ->where('is_default', false)
            ->defaultSort('-accounts.is_active', '-accounts.created_at')
            ->with('type');
        
        if (! auth()->user()->company->isDefault()) {
            $accounts->whereHas('user', function ($query) {
                    $query->where('users.company_id', auth()->user()->company_id);
                })
            ->orWhereHas('company', function ($query) {
                    $query->where('companies.uuid', auth()->user()->company_id);
                });
        }
        
        return $accounts;
    }
    
    public function getUmbrellaAccounts()
    {
        $accounts = QueryBuilder::for(Account::class)
            ->allowedFilters([
                AllowedFilter::scope('is_active'),
                AllowedFilter::scope('type_id'),
                AllowedFilter::partial('code'),
                AllowedFilter::custom('owner', new FiltersOwner()),
            ])
            ->where('is_default', false)
            ->defaultSort('-accounts.is_active', '-accounts.created_at')
            ->with('type');
    
        if (! auth()->user()->company->isDefault()) {
            $accounts->whereHas('user', function ($query) {
                $query->where('users.company_id', auth()->user()->company_id);
            })
                ->orWhereHas('company', function ($query) {
                    $query->where('companies.uuid', auth()->user()->company_id);
                });
        }
    
        return $accounts->whereHas('user');
    }
    
    public function getSystemCommissionBalance()
    {
        return $this->getSystemTotalCommission() - $this->getSystemTotalPayout();
    }
    
    public function getSystemTotalCommission()
    {
        return Transaction::where('status', config('business.transaction.status.success'))
            ->sum('system_commission');
    }
    
    public function getSystemTotalPayout()
    {
        return Payout::where('account_id', Account::where('is_default', true)->first()->uuid)
            ->whereIn('status', [
                config('business.payout.status.approved'),
                config('business.payout.status.pending'),
            ])
            ->where(function ($query) {
                $query->where('type_id', PayoutType::where('name', config('business.payout.type.commission'))->first()->uuid);
            })
            ->sum('amount');
    }
    
}
