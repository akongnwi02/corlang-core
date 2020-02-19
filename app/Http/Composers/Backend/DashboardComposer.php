<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/18/20
 * Time: 5:55 PM
 */

namespace App\Http\Composers\Backend;


use Illuminate\View\View;

class DashboardComposer
{
    
    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('company_account_balance', auth()->user()->company->account->account_balance_label)
            ->with('company_commission_balance', auth()->user()->company->company_commission_balance_label)
            ->with('company_today_commission', auth()->user()->company->company_today_commission_label)
            ->with('number_of_users', auth()->user()->company->getNumberOfUsers());
    }
    
}
