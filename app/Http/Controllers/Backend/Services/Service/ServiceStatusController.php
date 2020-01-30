<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 2:01 PM
 */

namespace App\Http\Controllers\Backend\Services\Service;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\Service\ChangeServiceStatusRequest;
use App\Models\Service\Service;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class ServiceStatusController extends Controller
{
    /**
     * @param ServiceRepository $serviceRepository
     * @param ChangeServiceStatusRequest $request
     * @param Service $service
     * @param $status
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(ServiceRepository $serviceRepository, ChangeServiceStatusRequest $request, Service $service, $status)
    {
        $serviceRepository->mark($service, $status);
        
        return redirect()->route('admin.services.service.index')
            ->withFlashSuccess(__('alerts.backend.services.service.status_updated'));
    }
}
