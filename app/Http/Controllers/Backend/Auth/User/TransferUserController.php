<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 11:35 AM
 */

namespace App\Http\Controllers\Backend\Auth\User;


use App\Http\Requests\Backend\Auth\User\TransferUserRequest;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Company\Company\CompanyRepository;

class TransferUserController
{
    protected $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function transfer(User $user, RoleRepository $roleRepository, CompanyRepository $companyRepository)
    {
        return view('backend.auth.user.transfer')
            ->withUser($user)
            ->withRoles($roleRepository->getAvailableRolesForCurrentUser()
                ->get(['id', 'name']))
            ->withCompanies($companyRepository->getCompaniesForCurrentUser()
                ->pluck('name', 'uuid')
                ->toArray());
    }
    
    public function send(TransferUserRequest $request, User $user)
    {
        $this->userRepository->transfer($user, $request->only(
            'company_id',
            'roles'
        ));
    
        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.transferred'));
    
    }
}
