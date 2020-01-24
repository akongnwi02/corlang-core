<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 1:52 PM
 */

namespace App\Http\Controllers\Backend\Services\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\Service\UpdateServiceRequest;
use App\Http\Requests\Backend\Services\Service\StoreServiceRequest;
use App\Models\Company\Company;
use App\Models\Company\CompanyType;
use App\Models\System\Setting;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Repositories\Backend\System\CountryRepository;

class ServiceController extends Controller
{
    
    public function index(ServiceRepository $serviceRepository)
    {
        return view('backend.services.service.index')
            ->withServices($serviceRepository->getAllServices()
                ->paginate());
    }
    
    public function create(CountryRepository $countryRepository)
    {
        return view('backend.companies.company.create')
            ->withCountries($countryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withTypes(CompanyType::get());
    }
    
    /**
     * @param StoreServiceRequest $request
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreServiceRequest $request, ServiceRepository $companyRepository)
    {
        $companyRepository->create($request->input());
        
        return redirect()
            ->route('admin.companies.company.index')
            ->withFlashSuccess(__('alerts.backend.companies.company.created'));
    }
    
    public function show()
    {
    
    }
    
    public function edit(Company $company, CountryRepository $countryRepository)
    {
        return view('backend.companies.company.edit')
            ->withCompany($company)
            ->withSetting(Setting::where('key', config('business.system.setting.key.default_agent_commission')))
            ->withCountries($countryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withTypes(CompanyType::get());
    }
    
    /**
     * @param UpdateServiceRequest $request
     * @param Company $company
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateServiceRequest $request, Company $company, ServiceRepository $companyRepository)
    {
        
        $logo = $request->has('logo') ? $request->file('logo') : null;
        
        $companyRepository->update($company, $request->input(), $logo);
        
        return redirect()
            ->route('admin.companies.company.index')
            ->withFlashSuccess(__('alerts.backend.companies.company.updated'));
    }
    
    public function destroy()
    {
    
    }
}
