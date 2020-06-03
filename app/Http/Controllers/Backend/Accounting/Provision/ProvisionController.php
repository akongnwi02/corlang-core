<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 12:11 AM
 */

namespace App\Http\Controllers\Backend\Accounting\Provision;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Accounting\RequestProvisionRequest;
use App\Models\Service\Service;
use App\Repositories\Backend\Accounting\BillerPaymentRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class ProvisionController extends Controller
{
    /**
     * @param ServiceRepository $serviceRepository
     * @return mixed
     */
    public function index(ServiceRepository $serviceRepository)
    {
        return view('backend.accounting.provision.index')
            ->withServices($serviceRepository->getAllServices()->paginate());
    }
    
    /**
     * @param RequestProvisionRequest $request
     * @param BillerPaymentRepository $billerPaymentRepository
     * @param Service $service
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function request(RequestProvisionRequest $request, BillerPaymentRepository $billerPaymentRepository, Service $service)
    {
        $billerPaymentRepository->request($service, $request->only(['amount', 'currency_id', 'comment']));
    
        return redirect()->route('admin.accounting.provision.index')
            ->withFlashSuccess(__('alerts.backend.accounting.collection.paid'));
    }
    
    public function show(Service $service)
    {
        return view('backend.accounting.provision.show')
            ->withMovements($service->provisions()
                ->paginate());
    }
}
