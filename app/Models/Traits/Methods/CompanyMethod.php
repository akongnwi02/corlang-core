<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 12:04 PM
 */

namespace App\Models\Traits\Methods;

use App\Models\Transaction\Transaction;
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
        return $this->getCompanyCommissionsTotal() - $this->account->getPayoutsTotal();
    }
    
    public function getCompanyCommissionsTotal()
    {
        return Transaction::where('company_id', $this->uuid)
            ->where('status', config('business.transaction.status.success'))
            ->sum('company_commission');
    }
    
    public function getCompanyTodayCommission()
    {
        $commission = Transaction::where('company_id', $this->uuid)
            ->where('created_at', '>=', Carbon::today())
            ->sum('company_commission');
        return $commission;
    }
}
