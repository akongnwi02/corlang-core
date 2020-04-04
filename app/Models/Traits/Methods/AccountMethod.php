<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 1:27 AM
 */

namespace App\Models\Traits\Methods;


use App\Models\Account\Account;
use App\Models\Account\Movement;
use App\Models\Account\MovementType;
use App\Models\Account\Payout;
use App\Models\Account\PayoutType;

trait AccountMethod
{
    public static function generateCode() {
        $code = mt_rand(100000000, 999999999);
        if (static::codeExists($code)) {
            static::generateCode();
        }
        
        return $code;
    }
    
    public static function codeExists($code) {
        return Account::where('code', $code)->exists();
    }
    
    public function isActive()
    {
        return $this->is_active;
    }
    
    public function isCompanyAccount()
    {
    
    }
    
    public function getCredit()
    {
        return Movement::where('is_reversed', false)
            ->where('destinationaccount_id', $this->uuid)
            ->where(function ($query) {
                $query->where('type_id', MovementType::where('name', config('business.movement.type.float'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.deposit'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.sale'))->first()->uuid);
            })
            ->sum('amount');
    }
    
    public function getDebit()
    {
        return Movement::where('is_reversed', false)
            ->where('destinationaccount_id', $this->uuid)
            ->where(function ($query) {
                $query->where('type_id', MovementType::where('name', config('business.movement.type.purchase'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.withdrawal'))->first()->uuid);
            })
            ->sum('amount');
    }
    
    public function getDrains()
    {
        return Payout::where('account_id', $this->uuid)
            ->where(function ($query) {
                $query->where('type_id', PayoutType::where('name', config('business.payout.type.drain'))->first()->uuid);
            })
            ->sum('amount');
    }
    
    public function getSales()
    {
        return Movement::where('is_reversed', false)
            ->where('user_id', $this->user->uuid)
            ->where(function ($query) {
                $query->where('type_id', MovementType::where('name', config('business.movement.type.purchase'))->first()->uuid);
            })
            ->sum('amount');
    }
    
    public function getUmbrellaBalance()
    {
        return $this->getSales() - $this->getDrains();
    }
    
    public function getBalance()
    {
        return $this->getCredit() - $this->getDebit();
    }
    
    public function getCommissionBalance()
    {
        if ($this->type->name == config('business.account.type.company')) {

            return $this->company->getCompanyCommissionBalance();
        }
        return $this->user->getUserCommissionBalance();
    }
    
    public function getPayoutsTotal()
    {
        $total = Payout::where('account_id', $this->uuid)
            ->whereIn('status', [
                config('business.payout.status.approved'),
                config('business.payout.status.pending'),
            ])
            ->where(function ($query) {
                $query->where('type_id', PayoutType::where('name', config('business.payout.type.commission'))->first()->uuid);
            })
            ->sum('amount');

        return $total;
    }
}
