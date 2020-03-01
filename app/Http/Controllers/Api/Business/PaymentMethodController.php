<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 3/1/20
 * Time: 12:24 PM
 */

namespace App\Http\Controllers\Api\Business;


use App\Http\Controllers\Controller;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;

class PaymentMethodController extends Controller
{
    public function index(PaymentMethodRepository $paymentMethodRepository)
    {
        return response()->json($paymentMethodRepository->getPaymentMethods()->get());
    }
}
