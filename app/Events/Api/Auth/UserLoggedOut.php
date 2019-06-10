<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/9/19
 * Time: 12:14 PM
 */

namespace App\Events\Api\Auth;


use App\Models\Auth\User;
use Illuminate\Queue\SerializesModels;

class UserLoggedOut
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}