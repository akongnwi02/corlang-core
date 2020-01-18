<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 9:46 PM
 */

namespace App\Repositories\Backend\Company\Company;

use App\Events\Backend\Company\Company\CompanyCreated;
use App\Events\Backend\Company\Company\CompanyDeactivated;
use App\Events\Backend\Company\Company\CompanyReactivated;
use App\Exceptions\GeneralException;
use App\Models\Company\Company;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyRepository
{
    protected $model;
    
    public function __construct(Company $company)
    {
        $this->model = $company;
    }
    
    /**
     * @param array $data
     * @return mixed
     * @throws \Throwable
     */
    public function create(array $data)
    {
        
        return \DB::transaction(function () use ($data) {
    
            $company = $this->model->create($data);
            
            if ($company) {
                event(new CompanyCreated($company));
                return $company;
            }
    
            throw new GeneralException(__('exceptions.backend.companies.company.create_error'));
        });
    }
    
    public function get()
    {
        $companies = QueryBuilder::for(Company::class)
            ->allowedFilters([
                AllowedFilter::scope('active'),
            ])
            ->allowedSorts('companies.is_active', 'companies.created_at', 'companies.name')
            ->defaultSort( '-companies.is_active', '-companies.is_default', '-companies.created_at', 'companies.name');
    
        if (!auth()->user()->company->isDefault()) {
            return $companies->where('users.id', auth()->user()->id)
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
        // other roles cannot reactivate
        if (! $company->isActive()) {
            if ($company->deactivator->isAdmin()
                && ! auth()->user()->isAdmin()) {
                
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
}
