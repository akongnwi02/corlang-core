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
use App\Models\Service\Service;
use App\Repositories\Backend\Services\Category\CategoryRepository;
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class ServiceController extends Controller
{
    
    /**
     * @param ServiceRepository $serviceRepository
     * @return mixed
     */
    public function index(ServiceRepository $serviceRepository)
    {
        return view('backend.services.service.index')
            ->withServices($serviceRepository->getAllServices()
                ->paginate());
    }
    
    /**
     * @param CommissionRepository $commissionRepository
     * @param CategoryRepository $categoryRepository
     * @return mixed
     */
    public function create(CommissionRepository $commissionRepository, CategoryRepository $categoryRepository)
    {
        return view('backend.services.service.create')
            ->withCommissions($commissionRepository->getAllCommissions()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withCategories($categoryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    /**
     * @param StoreServiceRequest $request
     * @param ServiceRepository $serviceRepository
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreServiceRequest $request, ServiceRepository $serviceRepository)
    {
    
        $logo = $request->has('logo') ? $request->file('logo') : null;
        
        $service = $serviceRepository->create($request->input(), $logo);
        
        return  $service->has_items ?
            redirect()->route('admin.services.service.edit', $service)
                ->withFlashSuccess(__('alerts.backend.services.service.created'))
            :
            redirect()->route('admin.services.service.index')
                ->withFlashSuccess(__('alerts.backend.services.service.created'));
    }
    
    public function show()
    {
        return 'COMING SOON';
    }
    
    /**
     * @param Service $service
     * @param CommissionRepository $commissionRepository
     * @param CategoryRepository $categoryRepository
     * @return mixed
     */
    public function edit(Service $service, CommissionRepository $commissionRepository, CategoryRepository $categoryRepository)
    {
        return view('backend.services.service.edit')
            ->withService($service)
            ->withCommissions($commissionRepository->getAllCommissions()
                ->pluck('name', 'uuid')
                ->toArray())
            ->withCategories($categoryRepository->get()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    /**
     * @param UpdateServiceRequest $request
     * @param Service $service
     * @param ServiceRepository $serviceRepository
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateServiceRequest $request, Service $service, ServiceRepository $serviceRepository)
    {
        
        $logo = $request->has('logo') ? $request->file('logo') : null;
        
        $service = $serviceRepository->update($service, $request->input(), $logo);
    
        return  $service->has_items ?
            redirect()->route('admin.services.service.edit', $service)
                ->withFlashSuccess(__('alerts.backend.services.service.updated'))
            :
            redirect()->route('admin.services.service.index')
                ->withFlashSuccess(__('alerts.backend.services.service.updated'));
    }
    
    public function destroy()
    {
    
    }
}
