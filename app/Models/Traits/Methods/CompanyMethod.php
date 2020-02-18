<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:04 PM
 */

namespace App\Models\Traits\Methods;


use App\Models\Account\Movement;
use App\Models\Account\MovementType;
use Carbon\Carbon;

trait CompanyMethod
{
    public function isActive()
    {
        return $this->is_active;
    }
    
    public function isDefault()
    {
        return $this->is_default;
    }
    
    public function getNumberOfUsers()
    {
        return $this->users()->count();
    }
    
    public function getCompanyCommissionBalance()
    {
        $commission = Movement::where('company_id', $this->uuid)
            ->where('is_reversed', false)
            ->where(function ($query) {
                $query->where('type_id', MovementType::where('name', config('business.movement.type.sale'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.purchase'))->first()->uuid);
            })
            ->sum('company_commission');
    
        return $commission;
    }
    
    public function getCompanyTodayCommission()
    {
        $commission = Movement::where('company_id', $this->uuid)
            ->where('created_at', Carbon::today())
            ->where('is_reversed', false)
            ->where(function ($query) {
                $query->where('type_id', MovementType::where('name', config('business.movement.type.sale'))->first()->uuid)
                    ->orWhere('type_id', MovementType::where('name', config('business.movement.type.purchase'))->first()->uuid);
            })
            ->sum('company_commission');
    
        return $commission;
    }
    
}
