<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Requests\Backend\Auth\User\UpdateUserStatusRequest;
use App\Models\Auth\User;
use App\Models\Auth\SocialAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ShowUserRequest;
use App\Repositories\Backend\Access\User\SocialRepository;

/**
 * Class UserSocialController.
 */
class UserSocialController extends Controller
{
    /**
     * @param ShowUserRequest $request
     * @param SocialRepository  $socialRepository
     * @param User              $user
     * @param SocialAccount     $social
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function unlink(UpdateUserStatusRequest $request, SocialRepository $socialRepository, User $user, SocialAccount $social)
    {
        $socialRepository->delete($user, $social);

        return redirect()->back()->withFlashSuccess(__('alerts.backend.users.social_deleted'));
    }
}
