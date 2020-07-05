<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/5/20
 * Time: 6:20 PM
 */

namespace App\Http\Controllers\Backend\Services\Service;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\Service\ServiceCompanyStoreRequest;
use App\Models\Service\Service;
use App\Repositories\Backend\Services\Service\ServiceCompanyRepository;

class ServiceCompanyController extends Controller
{
    /**
     * @param ServiceCompanyStoreRequest $request
     * @param Service $service
     * @param ServiceCompanyRepository $serviceCompanyRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(ServiceCompanyStoreRequest $request, Service $service, ServiceCompanyRepository $serviceCompanyRepository)
    {
        $serviceCompanyRepository->create($service, $request->input('company_ids'));
        
        return redirect()
            ->route('admin.services.service.edit', $service)
            ->withFlashSuccess(__('alerts.backend.services.company.updated'));
    }
}
