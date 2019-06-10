<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/9/19
 * Time: 1:12 PM
 */

namespace App\Events\Api\Auth;


use App\Models\Auth\User;
use Illuminate\Queue\SerializesModels;

class UserLoggedIn
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