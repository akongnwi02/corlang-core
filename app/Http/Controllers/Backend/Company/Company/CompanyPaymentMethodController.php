<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/26/20
 * Time: 2:41 PM
 */

namespace App\Http\Controllers\Backend\Company\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Company\Company\CompanyPaymentMethodUpdateRequest;
use App\Http\Requests\Backend\Company\Company\CompanyPaymentMethodStoreRequest;
use App\Http\Requests\Backend\Services\Service\ChangeServiceStatusRequest;
use App\Models\Company\Company;
use App\Models\Service\PaymentMethod;
use App\Repositories\Backend\Company\Company\CompanyPaymentMethodRepository;

class CompanyPaymentMethodController extends Controller
{
    /**
     * @param ChangeServiceStatusRequest $request
     * @param Company $company
     * @param PaymentMethod $method
     * @param $status
     * @param CompanyPaymentMethodRepository $companyPaymentMethodRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(ChangeServiceStatusRequest $request, Company $company, PaymentMethod $method, $status, CompanyPaymentMethodRepository $companyPaymentMethodRepository)
    {
        $companyPaymentMethodRepository->mark($company, $method, $status);
        
        return redirect()
            ->route('admin.companies.company.edit', $company)
            ->withFlashSuccess(__('alerts.backend.companies.method.status_updated'));
    }
    
    /**
     * @param CompanyPaymentMethodUpdateRequest $request
     * @param Company $company
     * @param PaymentMethod $method
     * @param CompanyPaymentMethodRepository $companyPaymentMethodRepository
     * @return string
     * @throws \App\Exceptions\GeneralException
     */
    public function update(CompanyPaymentMethodUpdateRequest $request, Company $company, PaymentMethod $method, CompanyPaymentMethodRepository $companyPaymentMethodRepository)
    {
        $companyPaymentMethodRepository->update($company, $method, $request->input());
        
        return redirect()
            ->route('admin.companies.company.edit', $company)
            ->withFlashSuccess(__('alerts.backend.companies.method.updated'));
    }
    
    /**
     * @param CompanyPaymentMethodStoreRequest $request
     * @param Company $company
     * @param CompanyPaymentMethodRepository $companyPaymentMethodRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(CompanyPaymentMethodStoreRequest $request, Company $company, CompanyPaymentMethodRepository $companyPaymentMethodRepository)
    {
        $companyPaymentMethodRepository->create($company, $request->input('method_ids'));
        
        return redirect()
            ->route('admin.companies.company.edit', $company)
            ->withFlashSuccess(__('alerts.backend.companies.method.updated'));
    }
}
