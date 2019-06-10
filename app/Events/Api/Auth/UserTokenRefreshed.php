<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/9/19
 * Time: 12:49 PM
 */

namespace App\Events\Api\Auth;


use App\Models\Auth\User;
use Illuminate\Queue\SerializesModels;

class UserTokenRefreshed
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