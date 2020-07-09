<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/10/20
 * Time: 12:06 AM
 */

namespace App\Http\Controllers\Api\Merchant\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Merchant\V1\OrderRequest;
use App\Repositories\Api\Merchant\V1\OrderRepository;

class OrderController extends Controller
{
    public function order(OrderRequest $request, OrderRepository $orderRepository)
    {
        $orderRepository->create($request->input());
    }
}
