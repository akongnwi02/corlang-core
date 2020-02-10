<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 8:15 PM
 */

namespace App\Repositories\Backend\Account;

use App\Events\Backend\Account\AccountDeactivated;
use App\Events\Backend\Account\AccountReactivated;
use App\Exceptions\GeneralException;

class AccountRepository
{
    /**
     * @param $account
     * @param $status
     * @return mixed
     * @throws GeneralException
     */
    public function mark($account, $status)
    {
        $account->is_active = $status;
    
        if ($account->save()) {
        
            switch ($status) {
                case 0:
                    event(new AccountDeactivated($account));
                    break;
            
                case 1:
                    event(new AccountReactivated($account));
                    break;
            }
        
            return $account;
        }
    
        throw new GeneralException(__('exceptions.backend.account.mark_error'));
    }
}
