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
use App\Models\Service\Service;
use App\Models\System\Setting;
use App\Repositories\Backend\Services\Category\CategoryRepository;
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;
use App\Repositories\Backend\System\CountryRepository;
use App\Repositories\Backend\System\GatewayRepository;

class ServiceController extends Controller
{
    
    public function index(ServiceRepository $serviceRepository)
    {
        return view('backend.services.service.index')
            ->withServices($serviceRepository->getAllServices()
                ->paginate());
    }
    
    public function create(GatewayRepository $gatewayRepository,  CommissionRepository $commissionRepository, CategoryRepository $categoryRepository)
    {
        return view('backend.services.service.create')
            ->withCommissions($commissionRepository->getAllCommissions()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withGateways($gatewayRepository->get()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withCategories($categoryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    /**
     * @param StoreServiceRequest $request
     * @return mixed
     * @throws \Throwable-is_active',
     * @throws \Throwable
     */
    public function store(StoreServiceRequest $request, ServiceRepository $serviceRepository)
    {
    
        $logo = $request->has('logo') ? $request->file('logo') : null;
        
        $serviceRepository->create($request->input(), $logo);
        
        return redirect()
            ->route('admin.services.service.index')
            ->withFlashSuccess(__('alerts.backend.services.service.created'));
    }
    
    public function show()
    {
    
    }
    
    public function edit(Service $service, CommissionRepository $commissionRepository, GatewayRepository $gatewayRepository, CategoryRepository $categoryRepository)
    {
        return view('backend.services.service.edit')
            ->withService($service)
            ->withCommissions($commissionRepository->getAllCommissions()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withGateways($gatewayRepository->get()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withCategories($categoryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    /**
     * @param UpdateServiceRequest $request
     * @param Company $company
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateServiceRequest $request, Service $service, ServiceRepository $serviceRepository)
    {
        
        $logo = $request->has('logo') ? $request->file('logo') : null;
        
        $serviceRepository->update($service, $request->input(), $logo);
        
        return redirect()
            ->route('admin.services.service.index')
            ->withFlashSuccess(__('alerts.backend.services.service.updated'));
    }
    
    public function destroy()
    {
    
    }
}
