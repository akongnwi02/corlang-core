<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/8/19
 * Time: 5:38 PM
 */

namespace App\Events\Api\Auth;


use Illuminate\Queue\SerializesModels;

class UserConfirmed
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