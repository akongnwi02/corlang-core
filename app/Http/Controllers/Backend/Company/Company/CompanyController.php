<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/12/20
 * Time: 10:53 PM
 */

namespace App\Http\Controllers\Backend\Company\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\StoreCompanyRequest;
use App\Models\Auth\User;
use App\Models\Company\CompanyType;
use App\Models\System\Country;
use App\Repositories\Backend\Company\Company\CompanyRepository;

class CompanyController extends Controller
{
    protected $companyRepository;
    
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    
    public function index()
    {

    }

    public function create()
    {
        return view('backend.companies.company.create')
            ->withCountries(Country::orderBy('is_default', 'desc')
                    ->orderBy('name', 'asc')
                ->pluck('name', 'uuid')
                ->toArray())
            ->withTypes(CompanyType::withoutCentral()->get());
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
