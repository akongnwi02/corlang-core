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
        return BillerPayment::where('service_id', $this->uuid)
            ->where('type_id', PayoutType::where('name', config('business.payout.type.collection'))->first()->uuid)
            ->sum('amount');
    }
    
    public function getTransactionAmount()
    {
        if ($this->is_money_withdrawal) {
            return $this->transactions()
                ->where('status', config('business.transaction.status.success'))
                ->sum('total_customer_amount');
        }
        return $this->transactions()
            ->where('status', config('business.transaction.status.success'))
            ->sum('amount');
    }
    
    public function getCollectedAmount()
    {
        return $this->getTransactionAmount() - $this->getPaidAmount();
    }
    
    public function getCommissionAmount()
    {
        return $this->getTransactionCommission() - $this->getRequestedAmount();
    }
    
    public function getTransactionCommission()
    {
        return $this->transactions()
            ->where('status', config('business.transaction.status.success'))
            ->sum('provider_service_fee');
    }
    
    public function getRequestedAmount()
    {
        return BillerPayment::where('service_id', $this->uuid)
            ->where('type_id', PayoutType::where('name', config('business.payout.type.provision'))->first()->uuid)
            ->sum('amount');
    }
}
