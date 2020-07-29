<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/27/20
 * Time: 8:54 AM
 */

namespace App\Events\Api\Merchant;


use App\Models\Merchant\MerchantOrder;
use Illuminate\Queue\SerializesModels;

class OrderPaymentInitiated
{
    use SerializesModels;
    
    public $order;
    
    public function __construct(MerchantOrder $order)
    {
        $this->order = $order;
    }
}
