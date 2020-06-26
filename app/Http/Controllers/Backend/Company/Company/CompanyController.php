<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/12/20
 * Time: 10:53 PM
 */

namespace App\Http\Controllers\Backend\Company\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Company\Company\UpdateCompanyRequest;
use App\Http\Requests\Backend\Company\Company\StoreCompanyRequest;
use App\Models\Company\Company;
use App\Models\Company\CompanyType;
use App\Models\System\Setting;
use App\Repositories\Backend\Company\Company\CompanyRepository;
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Repositories\Backend\System\CountryRepository;

class CompanyController extends Controller
{

    public function index(CompanyRepository $companyRepository)
    {
        return view('backend.companies.company.index')
            ->withCompanies($companyRepository->getCompaniesForCurrentUser()
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
     * @param StoreCompanyRequest $request
     * @param CompanyRepository $companyRepository
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreCompanyRequest $request, CompanyRepository $companyRepository)
    {
        $companyRepository->create($request->input());
    
        return redirect()
            ->route('admin.companies.company.index')
            ->withFlashSuccess(__('alerts.backend.companies.company.created'));
    }

    public function show()
    {
        return 'COMING SOON';
    }

    public function edit(
        Company $company,
        CountryRepository $countryRepository,
        CompanyRepository $companyRepository,
        ServiceRepository $serviceRepository,
        CommissionRepository $commissionRepository,
        PaymentMethodRepository $paymentMethodRepository
    )
    {
//        dd($serviceRepository->getAllActiveServices()->pluck('name', 'uuid'));
        return view('backend.companies.company.edit')
            ->withCompanyServices($companyRepository->getAvailableServices($company)->get())
            ->withCompanyMethods($companyRepository->getAvailablePaymentMethods($company)->get())
            ->withServices($serviceRepository->getAllActiveServices()->get())
            ->withPaymentMethods($paymentMethodRepository->getPaymentMethods()->get())
            ->withCompany($company)
            ->withCommissions($commissionRepository->getAllCommissions()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withCountries($countryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withTypes(CompanyType::get());
    }
    
    /**
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @param CompanyRepository $companyRepository
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateCompanyRequest $request, Company $company, CompanyRepository $companyRepository)
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
