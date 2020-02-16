<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/14/20
 * Time: 4:08 PM
 */

namespace App\Http\Controllers\Backend\Company\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Company\Company\ChangeCompanyRequest;
use App\Models\Company\Company;
use App\Repositories\Backend\Company\Company\CompanyRepository;

class ChangeCompanyController extends Controller
{
    /**
     * @param ChangeCompanyRequest $request
     * @param Company $company
     * @param CompanyRepository $companyRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function login(ChangeCompanyRequest $request, Company $company, CompanyRepository $companyRepository)
    {
        $companyRepository->changeCompany(auth()->user(), $company);
    
        return redirect()
            ->route('admin.dashboard')
            ->withFlashSuccess(__('alerts.backend.companies.company.logged_in'));
    }
}
