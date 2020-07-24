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
    
    public function link(ShowLinkRequest $request, MerchantOrder $order, CompanyRepository $companyRepository)
    {
        return view('frontend.merchant.dashboard')
            ->withOrder(new MerchantOrderResource($order))
            ->withMethods($companyRepository->getAvailablePaymentMethods($order->company)->where('is_realtime', true)->get());
    }
    
    public function destroy(DeleteOrderRequest $request, OrderRepository $orderRepository, $external_id)
    {
        $orderRepository->destroy($external_id);
        
        return response()->json([], 204);
    }
    
}
