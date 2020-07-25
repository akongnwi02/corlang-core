<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/25/20
 * Time: 2:35 PM
 */

namespace App\Http\Controllers\Backend\Orders;


use App\Http\Controllers\Controller;
use App\Repositories\Api\Merchant\V1\OrderRepository;

class MerchantOrdersController extends Controller
{
    public function index(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->getAllOrders();
    
        return view('backend.orders.index')
            ->withOrders($orders->paginate());

    }
//
//    public function download()
//    {
//
//    }
}
