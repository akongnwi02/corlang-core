<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Requests\Backend\Auth\User\UpdateUserStatusRequest;
use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\ShowUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Repositories\Backend\Company\Company\CompanyRepository;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ShowUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.user.index')
            ->withUsers($this->userRepository->getUsers()
                ->paginate());
    }

    /**
     * @param ShowUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(RoleRepository $roleRepository, CompanyRepository $companyRepository)
    {
        return view('backend.auth.user.create')
            ->withRoles($roleRepository->with('permissions')->getAvailableRolesForCurrentUser()
                ->get(['id', 'name']))
            ->withCompanies($companyRepository->getCompaniesForCurrentUser()
                ->pluck('name', 'uuid')
                ->toArray());
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreUserRequest $request)
    {
        $this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'username',
            'phone',
            'email',
            'password',
            'active',
            'confirmed',
            'confirmation_message',
            'roles',
            'notification_channel',
            'permissions',
            'company_id'
        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.created'));
    }
    
    /**
     * @param ShowUserRequest $request
     * @param User $user
     *
     * @return mixed
     */
    public function show(ShowUserRequest $request, User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }
    
    /**
     * @param ShowUserRequest $request
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User $user
     *
     * @return mixed
     */
    public function edit(ShowUserRequest $request, RoleRepository $roleRepository, CompanyRepository $companyRepository, User $user)
    {
        return view('backend.auth.user.edit')
            ->withUser($user)
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withCompanies($companyRepository->getCompaniesForCurrentUser()
                ->pluck('name', 'uuid')
                ->toArray());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->only(
            'first_name',
            'last_name',
            'username',
            'phone',
            'notification_channel',
            'email',
            'roles',
            'permissions'
        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ShowUserRequest $request
     * @param User              $user
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(UpdateUserStatusRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }
}
