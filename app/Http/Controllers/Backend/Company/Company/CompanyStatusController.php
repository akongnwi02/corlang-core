<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:39 PM
 */

namespace App\Http\Controllers\Backend\Company\Company;


use App\Http\Requests\Backend\Company\Company\ChangeCompanyStatusRequest;
use App\Models\Company\Company;
use App\Repositories\Backend\Company\Company\CompanyRepository;

class CompanyStatusController
{
    protected $companyRepository;
    
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    
    /**
     * @param ChangeCompanyStatusRequest $request
     * @param Company $company
     * @param $status
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(ChangeCompanyStatusRequest $request, Company $company, $status)
    {
        $this->companyRepository->mark($company, $status);
    
        return redirect()->route('admin.companies.company.index')
            ->withFlashSuccess(__('alerts.backend.companies.company.status_updated'));
    }
}
