<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/3/20
 * Time: 11:55 PM
 */

namespace App\Http\Controllers\Backend\Company\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Company\Company\CompanyServiceUpdateRequest;
use App\Http\Requests\Backend\Services\Service\ChangeServiceStatusRequest;
use App\Models\Company\Company;
use App\Models\Service\Service;
use App\Repositories\Backend\Company\Company\CompanyServiceRepository;

class CompanyServiceController extends Controller
{
    
    /**
     * @param ChangeServiceStatusRequest $request
     * @param Company $company
     * @param Service $service
     * @param $status
     * @param CompanyServiceRepository $companyServiceRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(ChangeServiceStatusRequest $request, Company $company, Service $service, $status, CompanyServiceRepository $companyServiceRepository)
    {
        $companyServiceRepository->mark($company, $service, $status);
    
        return redirect()
            ->route('admin.companies.company.edit', $company)
            ->withFlashSuccess(__('alerts.backend.companies.service.status_updated'));
    }
    
    /**
     * @param Company $company
     * @param Service $service
     * @param CompanyServiceUpdateRequest $request
     * @param CompanyServiceRepository $companyServiceRepository
     * @return string
     * @throws \App\Exceptions\GeneralException
     */
    public function update(CompanyServiceUpdateRequest $request, Company $company, Service $service, CompanyServiceRepository $companyServiceRepository)
    {
        $companyServiceRepository->update($company, $service, $request->input());
    
        return redirect()
            ->route('admin.companies.company.edit', $company)
            ->withFlashSuccess(__('alerts.backend.companies.service.updated'));
    }
}
