<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 7/26/20
 * Time: 5:24 PM
 */

namespace App\Events\Api\Merchant;


use App\Models\Merchant\MerchantOrder;
use Illuminate\Queue\SerializesModels;

class OrderUpdated
{
    use SerializesModels;
    
    public $order;
    
    public function __construct(MerchantOrder $order)
    {
        $this->order = $order;
    }
}
