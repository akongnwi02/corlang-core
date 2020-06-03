<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 12:11 AM
 */

namespace App\Http\Controllers\Backend\Accounting\Collection;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Accounting\PayoutCollectionRequest;
use App\Models\Service\Service;
use App\Repositories\Backend\Accounting\BillerPaymentRepository;
use App\Repositories\Backend\Services\Service\ServiceRepository;

class CollectionController extends Controller
{
    /**
     * @param ServiceRepository $serviceRepository
     * @return mixed
     */
    public function index(ServiceRepository $serviceRepository)
    {
        return view('backend.accounting.collection.index')
            ->withServices($serviceRepository->getAllServices()->paginate());
    }
    
    /**
     * @param Service $service
     * @return mixed
     */
    public function show(Service $service)
    {
        return view('backend.accounting.collection.show')
            ->withMovements($service->collections()
                ->paginate());
    }
    
    /**
     * @param PayoutCollectionRequest $request
     * @param BillerPaymentRepository $billerPaymentRepository
     * @param Service $service
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function pay(PayoutCollectionRequest $request, BillerPaymentRepository $billerPaymentRepository, Service $service)
    {
        $billerPaymentRepository->payout($service, $request->only(['amount', 'currency_id', 'comment']));
    
        return redirect()->route('admin.accounting.collection.index')
            ->withFlashSuccess(__('alerts.backend.accounting.collection.paid'));
    }
}
