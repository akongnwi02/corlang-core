<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/9/20
 * Time: 10:28 PM
 */

namespace App\Events\Backend\Account;

use Illuminate\Queue\SerializesModels;

class AccountDeactivated
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
