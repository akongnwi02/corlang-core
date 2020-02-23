<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/23/20
 * Time: 6:44 PM
 */

namespace App\Repositories\Backend\Services\Service;


use App\Models\Service\PaymentMethod;

class PaymentMethodRepository
{
    public function getPaymentMethods()
    {
        return PaymentMethod::active();
    }
}
