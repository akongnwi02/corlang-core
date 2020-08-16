<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/10/20
 * Time: 12:06 AM
 */

namespace App\Http\Controllers\Api\Merchant\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Merchant\V1\StoreOrderRequest;
use App\Http\Requests\Api\Merchant\V1\ShowOrderRequest;
use App\Http\Requests\Api\Merchant\V1\DeleteOrderRequest;
use App\Http\Requests\Api\Merchant\V1\ShowLinkRequest;
use App\Http\Resources\Api\Merchant\V1\MerchantOrderResource;
use App\Models\Merchant\MerchantOrder;
use App\Repositories\Api\Merchant\V1\OrderRepository;
use App\Repositories\Backend\Company\Company\CompanyRepository;
use App\Repositories\Backend\Services\Service\PaymentMethodRepository;
use App\Repositories\Backend\System\CurrencyRepository;

class OrderController extends Controller
{
    public function order(StoreOrderRequest $request, OrderRepository $orderRepository)
    {
        $order = $orderRepository->create($request->input(), auth()->user());
        
        return new MerchantOrderResource($order) ;
    }
    
    public function show(ShowOrderRequest $request, OrderRepository $orderRepository, $external_id)
    {
        $order = $orderRepository->show($external_id);

        return new MerchantOrderResource($order);
    }
    
    public function index(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->getAllOrders()
            ->paginate()
            ->appends(request()->query());
        
        return MerchantOrderResource::collection($orders);
    }
    
    public function link(
        ShowLinkRequest $request,
        MerchantOrder $order,
        CompanyRepository $companyRepository,
        PaymentMethodRepository $paymentMethodRepository,
        CurrencyRepository $currencyRepository
    ) {
        $methods = $companyRepository->getAvailablePaymentMethods($order->company)->where('is_realtime', true)->get();
        
        foreach ($methods as $method) {
            $customerFee = $paymentMethodRepository->getCustomerOrderFee($method, $order);
            $paymentCustomerFee = $currencyRepository->convertAmount($customerFee, $order->payment_currency_code, true);
            
            $method->customer_fee = (float) $customerFee;
            $method->payment_customer_fee = (float) $paymentCustomerFee;
        }
        
        return view('frontend.merchant.dashboard')
            ->withOrder(new MerchantOrderResource($order))
            ->withMethods($methods);
    }
    
    public function destroy(DeleteOrderRequest $request, OrderRepository $orderRepository, $external_id)
    {
        $orderRepository->destroy($external_id);
        
        return response()->json([], 204);
    }
    
}
