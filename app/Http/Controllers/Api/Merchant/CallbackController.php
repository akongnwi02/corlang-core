<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/13/20
 * Time: 10:58 PM
 */

namespace App\Http\Controllers\Api\Merchant;


use App\Http\Controllers\Controller;
use App\Models\Merchant\MerchantOrder;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function callback(Request $request, MerchantOrder $order)
    {
    
    }
}
