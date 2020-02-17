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
                AllowedFilter::scope('is_active'),
                AllowedFilter::scope('type_id'),
            ])
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
}
