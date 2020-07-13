<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 9:46 PM
 */

namespace App\Repositories\Backend\Company\Company;

use App\Events\Backend\Companies\Company\CompanyCreated;
use App\Events\Backend\Companies\Company\CompanyDeactivated;
use App\Events\Backend\Companies\Company\CompanyReactivated;
use App\Events\Backend\Companies\Company\CompanyUpdated;
use App\Exceptions\GeneralException;
use App\Models\Account\Account;
use App\Models\Account\AccountType;
use App\Models\Account\Strongbox;
use App\Models\Auth\User;
use App\Models\Company\Company;
use JD\Cloudder\Facades\Cloudder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyRepository
{
    /**
     * @param array $data
     * @return mixed
     * @throws \Throwable
     */
    public function create(array $data)
    {
        $company = (new Company())->fill($data);
        
        $company->direct_polling = request()->has('direct_polling') ? 1 : 0;
        $company->is_merchant = request()->has('is_merchant') ? 1 : 0;

        // create account for the company
        $account = new Account();
        $account->code = Account::generateCode();
        $account->type_id = AccountType::where('name', config('business.account.type.company'))->first()->uuid;
    
        $strongbox = new Strongbox();
        $strongbox->balance = 0;
        
        if ($company->save()) {
            $account->owner_id = $company->uuid;
            $strongbox->company_id = $company->uuid;
            if ($account->save() && $strongbox->save()) {
                event(new CompanyCreated($company));
                return $company;
            }
            
        }

        throw new GeneralException(__('exceptions.backend.companies.company.create_error'));
    }
    
    /**
     * Returns all the company the user can access.
     * Users in the central company can see all other companies
     *
     * @return QueryBuilder
     */
    public function getCompaniesForCurrentUser()
    {
        $companies = QueryBuilder::for(Company::class)
            ->allowedFilters([
                AllowedFilter::scope('active'),
            ])
            ->allowedSorts('companies.is_active', 'companies.created_at', 'companies.name')
            ->defaultSort( '-companies.is_active', '-companies.is_default', '-companies.created_at', 'companies.name');
        
        if (! auth()->user()->company->isDefault()) {
            return $companies->select('companies.*')
                ->where('users.id', auth()->user()->id)
                ->join('users', 'users.company_id', '=', 'companies.uuid');
        }
        
        return $companies;
    }
    
    /**
     * @param $company
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($company, $status)
    {
        $company->is_active = $status;
    
        if ($company->save()) {
            
            switch ($status) {
                case 0:
                    $company->deactivated_by_id = auth()->user()->uuid;
                    event(new CompanyDeactivated($company));
                    
                    break;
            
                case 1:
                    $company->deactivated_by_id = null;
                    event(new CompanyReactivated($company));
                    break;
            }
    
            return $company;
        }
    
        throw new GeneralException(__('exceptions.backend.companies.company.mark_error'));
    }
    
    /**
     * @param $company
     * @param $data
     * @return mixed
     * @throws \Throwable
     */
    public function update(Company $company, $data, $logo = null)
    {
        $company->direct_polling = request()->has('direct_polling') ? 1 : 0;
        $company->is_merchant = request()->has('is_merchant') ? 1 : 0;
        
        $company->fill($data);

        $restricted = array_intersect(['is_provider', 'agent_self_topup', 'direct_polling'], array_keys($company->getDirty()));

        if ($restricted) {
            if ( auth()->user()->company->isDefault() && auth()->user()->isAdmin()) {
            
            } else {
                \Log::error('cannot update the following flags', $restricted);
                
                throw new GeneralException(__('exceptions.backend.companies.company.cant_change_check_box'));
            }
        }
        
        if ($logo) {
            $uploaded = Cloudder::upload($logo);
    
            if ($uploaded) {
                $company->logo_url = Cloudder::secureShow(Cloudder::getPublicId());
            }

        }
    
        if ($company->update()) {
            
            event(new CompanyUpdated($company));
            
            return $company;
        }
    
        throw new GeneralException(__('exceptions.backend.companies.company.update_error'));
    }
    
    public function getAvailableServices($company)
    {
        return $company->services()->where('services.is_active', true);
    }
    
    public function getAvailablePaymentMethods($company)
    {
        return $company->methods()->where('paymentmethods.is_active', true);
    }
    
    /**
     * @param User $user
     * @param $company
     * @return bool
     * @throws GeneralException
     */
    public function changeCompany(User $user, $company)
    {
        $user->company_id = $company->uuid;
    
        $user->is_comp_temp = $company->isDefault() ? 0 : 1;
    
        if ($user->save()) {
            
            return true;
        }
    
        throw new GeneralException(__('exceptions.backend.companies.company.login_error'));
    }
}
