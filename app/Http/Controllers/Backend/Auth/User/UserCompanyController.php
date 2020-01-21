<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 11:35 AM
 */

namespace App\Http\Controllers\Backend\Auth\User;


use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\RoleRepository;

class UserCompanyController
{
    public function transfer(UpdateUserRequest $request, User $user, RoleRepository $roleRepository)
    {
        return view('backend.auth.user.deactivated')
            ->withUser($user)
            ->withRoles($roleRepository->getAvailableRolesForCurrentUser()
                ->get(['id', 'name']));
    }
}
