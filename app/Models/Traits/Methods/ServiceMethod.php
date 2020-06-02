<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:04 PM
 */

namespace App\Models\Traits\Methods;


use App\Models\Account\BillerPayment;
use App\Models\Account\PayoutType;

trait ServiceMethod
{
    public function isActive()
    {
        return $this->is_active;
    }
    
    public function getPaidAmount()
    {
        $total = BillerPayment::where('service_id', $this->uuid)
            ->where('type_id', PayoutType::where('name', config('business.payout.type.collection'))->first()->uuid)
            ->sum('amount');
        return $total;
    }
    
    public function getTransactionAmount()
    {
        return $this->transactions()
            ->where('status', config('business.transaction.status.success'))
            ->sum('amount');
    }
    
    public function getCollectedAmount()
    {
        return $this->getTransactionAmount() - $this->getPaidAmount();
    }
}
