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
    public function index(PaymentMethodRepository $paymentMethodRepository)
    {
        return view('backend.services.payment-method.index')
            ->withMethods($paymentMethodRepository->getAllPaymentMethods()
                ->with(['service', 'commission'])
                ->paginate());
    }
    
    public function edit(PaymentMethod $method, CommissionRepository $commissionRepository)
    {
        return view('backend.services.payment-method.edit')
            ->withService($method)
            ->withCommissions($commissionRepository->getAllCommissions()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $method, PaymentMethodRepository $paymentMethodRepository)
    {
        $paymentMethodRepository->update($method, $request->input());
        
        return redirect()->route('admin.services.method.index')
            ->withFlashSuccess(__('alerts.backend.services.method.updated'));
    }
}
