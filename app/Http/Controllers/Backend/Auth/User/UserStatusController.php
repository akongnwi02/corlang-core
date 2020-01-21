<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserStatusRequest;
use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ShowUserRequest;

/**
 * Class UserStatusController.
 */
class UserStatusController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ShowUserRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ShowUserRequest $request)
    {
        return view('backend.auth.user.deactivated')
            ->withUsers($this->userRepository->getInactivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ShowUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ShowUserRequest $request)
    {
        return view('backend.auth.user.deleted')
            ->withUsers($this->userRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
    
    /**
     * @param ShowUserRequest $request
     * @param User $user
     * @param                   $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(UpdateUserStatusRequest $request, User $user, $status)
    {
        $this->userRepository->mark($user, $status);

        return redirect()->route(
            $status == 1 ?
            'admin.auth.user.index' :
            'admin.auth.user.deactivated'
        )->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ShowUserRequest $request
     * @param User              $deletedUser
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(UpdateUserStatusRequest $request, User $deletedUser)
    {
        $this->userRepository->forceDelete($deletedUser);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted_permanently'));
    }
    
    /**
     * @param ShowUserRequest $request
     * @param User $deletedUser
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(UpdateUserStatusRequest $request, User $deletedUser)
    {
        $this->userRepository->restore($deletedUser);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.restored'));
    }
}
