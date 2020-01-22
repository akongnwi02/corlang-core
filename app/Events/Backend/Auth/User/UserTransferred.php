<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/22/20
 * Time: 1:29 AM
 */

namespace App\Events\Backend\Auth\User;


use Illuminate\Queue\SerializesModels;

class UserTransferred
{
    use SerializesModels;
    
    /**
     * @var
     */
    public $user;
    
    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
