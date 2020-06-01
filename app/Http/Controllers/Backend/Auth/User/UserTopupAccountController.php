<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/1/20
 * Time: 11:28 PM
 */

namespace App\Http\Controllers\Backend\Auth\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ResetUserPinRequest;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\UserRepository;

class UserTopupAccountController extends Controller
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
        $userRepository->resetTopupAccount($user);
    
        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.reset_topup_account'));
    }
}
