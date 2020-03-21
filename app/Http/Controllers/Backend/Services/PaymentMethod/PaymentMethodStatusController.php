<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/21/20
 * Time: 11:08 AM
 */

namespace App\Http\Controllers\Backend\Services\PaymentMethod;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\PaymentMethod\ChangePaymentMethodStatusRequest;
use App\Models\Service\PaymentMethod;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;

class PaymentMethodStatusController extends Controller
{
    /**
     * @param PaymentMethodRepository $paymentMethodRepository
     * @param ChangePaymentMethodStatusRequest $request
     * @param PaymentMethod $method
     * @param $status
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(PaymentMethodRepository $paymentMethodRepository, ChangePaymentMethodStatusRequest $request, PaymentMethod $method, $status)
    {
        $paymentMethodRepository->mark($method, $status);
        
        return redirect()->route('admin.services.method.index')
            ->withFlashSuccess(__('alerts.backend.services.method.status_updated'));
    }
}
