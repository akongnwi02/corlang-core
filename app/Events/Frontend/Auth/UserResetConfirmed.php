<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 8/9/19
 * Time: 9:44 AM
 */

namespace App\Events\Frontend\Auth;


use Illuminate\Queue\SerializesModels;

class UserResetConfirmed
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
