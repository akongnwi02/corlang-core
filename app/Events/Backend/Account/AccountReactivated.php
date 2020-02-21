<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/13/20
 * Time: 10:13 PM
 */

namespace App\Events\Backend\Account;

use Illuminate\Queue\SerializesModels;

class AccountReactivated
{
    use SerializesModels;
    
    /**
     * @var
     */
    public $account;
    
    /**
     * @param $account
     */
    public function __construct($account)
    {
        $this->account = $account;
    }
}
