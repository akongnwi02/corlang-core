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
use App\Repositories\Backend\System\CountryRepository;

class CompanyController extends Controller
{
    protected $companyRepository;
    protected $countryRepository;
    
    public function __construct(
        CompanyRepository $companyRepository,
        CountryRepository $countryRepository
    )
    {
        $this->companyRepository = $companyRepository;
        $this->countryRepository = $countryRepository;
    }
    
    public function index()
    {
        return view('backend.companies.company.index')
            ->withCompanies($this->companyRepository->getCompaniesForCurrentUser()
                ->paginate());
    }

    public function create()
    {
        return view('backend.companies.company.create')
            ->withCountries($this->countryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withTypes(CompanyType::get());
    }
    
    /**
     * @param StoreCompanyRequest $request
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreCompanyRequest $request)
    {
        $this->companyRepository->create($request->input());
    
        return redirect()
            ->route('admin.companies.company.index')
            ->withFlashSuccess(__('alerts.backend.companies.company.created'));
    }

    public function show()
    {

    }

    public function edit(Company $company)
    {
        return view('backend.companies.company.edit')
            ->withCompany($company)
            ->withSetting(Setting::where('key', config('business.system.setting.key.default_agent_commission')))
            ->withCountries($this->countryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withTypes(CompanyType::get());
    }
    
    /**
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
  
        $logo = $request->has('logo') ? $request->file('logo') : null;
    
        $this->companyRepository->update($company, $request->input(), $logo);
    
        return redirect()
            ->route('admin.companies.company.index')
            ->withFlashSuccess(__('alerts.backend.companies.company.updated'));
    }
    
    public function destroy()
    {

    }
}
