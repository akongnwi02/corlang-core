<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/5/20
 * Time: 7:35 PM
 */

namespace App\Http\Controllers\Backend\Services\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Services\Commission\PaymentMethodCompanyStoreRequest;
use App\Models\Service\PaymentMethod;
use App\Repositories\Backend\Services\Service\PaymentMethodCompanyRepository;

class PaymentMethodCompanyController extends Controller
{
    /**
     * @param PaymentMethodCompanyStoreRequest $request
     * @param PaymentMethod $method
     * @param PaymentMethodCompanyRepository $paymentMethodCompanyRepository
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(PaymentMethodCompanyStoreRequest $request, PaymentMethod $method, PaymentMethodCompanyRepository $paymentMethodCompanyRepository)
    {
        $paymentMethodCompanyRepository->create($method, $request->input('company_ids'));
        
        return redirect()
            ->route('admin.services.method.edit', $method)
            ->withFlashSuccess(__('alerts.backend.services.method.company_updated'));
    }
}
