<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/12/20
 * Time: 10:53 PM
 */

namespace App\Http\Controllers\Backend\Company\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Company\Company\StoreCompanyRequest;
use App\Models\Company\CompanyType;
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
            ->withCompanies($this->companyRepository->get()
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
    
        return redirect()->route('admin.companies.company.index')->withFlashSuccess(__('alerts.backend.companies.company.created'));
    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function destroy()
    {

    }
}
