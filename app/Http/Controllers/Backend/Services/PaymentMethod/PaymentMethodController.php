<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/21/20
 * Time: 11:08 AM
 */

namespace App\Http\Controllers\Backend\Services\PaymentMethod;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\PaymentMethod\UpdatePaymentMethodRequest;
use App\Models\Service\PaymentMethod;
use App\Repositories\Backend\Services\Commission\CommissionRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;

class PaymentMethodController extends Controller
{
    /**
     * @param PaymentMethodRepository $paymentMethodRepository
     * @return mixed
     */
    public function index(PaymentMethodRepository $paymentMethodRepository)
    {
        return view('backend.services.payment-method.index')
            ->withMethods($paymentMethodRepository->getPaymentMethods()
                ->with(['service', 'customer_commission', 'provider_commission'])
                ->paginate());
    }
    
    /**
     * @param PaymentMethod $method
     * @param CommissionRepository $commissionRepository
     * @return mixed
     */
    public function edit(PaymentMethod $method, CommissionRepository $commissionRepository)
    {
        return view('backend.services.payment-method.edit')
            ->withMethod($method)
            ->withCommissions($commissionRepository->getAllCommissions()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    /**
     * @param UpdatePaymentMethodRequest $request
     * @param PaymentMethod $method
     * @param PaymentMethodRepository $paymentMethodRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $method, PaymentMethodRepository $paymentMethodRepository)
    {
        $paymentMethodRepository->update($method, $request->input());
        
        return redirect()->route('admin.services.method.index')
            ->withFlashSuccess(__('alerts.backend.services.method.updated'));
    }
}
