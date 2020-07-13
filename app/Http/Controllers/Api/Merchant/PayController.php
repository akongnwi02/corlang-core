<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/13/20
 * Time: 5:58 PM
 */

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Merchant\V1\PayRequest;
use App\Models\Merchant\MerchantOrder;

class PayController extends Controller
{
    public function pay(PayRequest $request, MerchantOrder $order)
    {
        \Log::info('Incoming merchant payment request', ['input' =>request()->input()]);
        
        $order->status = config('business.transaction.status.processing');
    }
}
