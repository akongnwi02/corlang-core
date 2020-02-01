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
use App\Models\Company\Company;
use Illuminate\Support\Facades\Storage;
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
        
        return \DB::transaction(function () use ($data) {
    
            $company = Company::create($data);
            
            $company->is_provider = request()->has('is_provider') ? 1 : 0;
            $company->is_provider = request()->has('agent_self_topup') ? 1 : 0;
            $company->is_provider = request()->has('direct_polling') ? 1 : 0;
    
            if ($company) {
                event(new CompanyCreated($company));
                return $company;
            }
    
            throw new GeneralException(__('exceptions.backend.companies.company.create_error'));
        });
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
        // if the company was deactivated by an administrator
        // lesser roles cannot reactivate
        if (! $company->isActive()) {
            if ($company->deactivator->company->isDefault() && ! auth()->user()->isAdmin()) {
                
                throw new GeneralException(__('exceptions.backend.companies.company.mark_rights_error'));
            }
        }
    
        $company->is_active = $status;
    
        if ($company->save()) {
            
            switch ($status) {
                case 0:
                    event(new CompanyDeactivated($company));
                    break;
            
                case 1:
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
    public function update($company, $data, $logo = null)
    {
        
        $company->fill($data);
        $company->is_provider = request()->has('is_provider') ? 1 : 0;
        $company->is_provider = request()->has('agent_self_topup') ? 1 : 0;
        $company->is_provider = request()->has('direct_polling') ? 1 : 0;
        if ($logo) {
            // delete previous logo
            if (strlen($company->logo_url)) {
                Storage::disk('public')->delete($company->logo_url);
            }
            
            $company->logo_url = $logo->store('/logos', 'public');
            
        }
    
        if ($company->update()) {
            
            event(new CompanyUpdated($company));
            
            return $company;
        }
    
        throw new GeneralException(__('exceptions.backend.companies.company.update_error'));
    }
}
