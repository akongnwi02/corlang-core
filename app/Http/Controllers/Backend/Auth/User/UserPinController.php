<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/27/20
 * Time: 1:31 AM
 */

namespace App\Http\Controllers\Backend\Auth\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ResetUserPinRequest;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\UserRepository;

class UserPinController extends Controller
{
    /**
     * @param ResetUserPinRequest $request
     * @param UserRepository $userRepository
     * @param User $user
     * @return mixed
     * @throws \Throwable
     */
    public function reset(ResetUserPinRequest $request, UserRepository $userRepository, User $user)
    {
        $userRepository->resetPin($user);
    
        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.reset_pin'));
    }
}
