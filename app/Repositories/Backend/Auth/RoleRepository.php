<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Auth\Role;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Auth\Role\RoleCreated;
use App\Events\Backend\Auth\Role\RoleUpdated;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class RoleRepository.
 */
class RoleRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * @param array $data
     *
     * @return Role
     * @throws GeneralException
     */
    public function create(array $data) : Role
    {
        // Make sure it doesn't already exist
        if ($this->roleExists($data['name'])) {
            throw new GeneralException(__('exceptions.backend.access.roles.name_exists', ['name' => $data['name']]));
        }

        if (! isset($data['permissions']) || ! \count($data['permissions'])) {
            $data['permissions'] = [];
        }

        //See if the role must contain a permission as per config
        if (config('access.roles.role_must_contain_permission') && \count($data['permissions']) === 0) {
            throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
        }

        return DB::transaction(function () use ($data) {
            $role = parent::create(['name' => strtolower($data['name'])]);

            if ($role) {
                $role->givePermissionTo($data['permissions']);

                event(new RoleCreated($role));

                return $role;
            }

            throw new GeneralException(trans('exceptions.backend.access.roles.create_error'));
        });
    }

    /**
     * @param Role  $role
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Role $role, array $data)
    {
        if ($role->isAdmin()) {
            throw new GeneralException('You can not edit the administrator role.');
        }

        // If the name is changing make sure it doesn't already exist
        if ($role->name !== strtolower($data['name'])) {
            if ($this->roleExists($data['name'])) {
                throw new GeneralException(__('exceptions.backend.access.roles.name_exists', ['name' => $data['name']]));
            }
        }

        if (! isset($data['permissions']) || ! \count($data['permissions'])) {
            $data['permissions'] = [];
        }

        //See if the role must contain a permission as per config
        if (config('access.roles.role_must_contain_permission') && \count($data['permissions']) === 0) {
            throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
        }

        return DB::transaction(function () use ($role, $data) {
            if ($role->update([
                'name' => strtolower($data['name']),
            ])) {
                $role->syncPermissions($data['permissions']);

                event(new RoleUpdated($role));

                return $role;
            }

            throw new GeneralException(trans('exceptions.backend.access.roles.update_error'));
        });
    }
    
    public function getAvailableRolesForCurrentUser()
    {
        $roles = QueryBuilder::for(Role::class)
            ->allowedFilters([
                AllowedFilter::scope('active'),
            ])
            ->allowedSorts('roles.id', 'roles.name')
            ->defaultSort( '-roles.id', 'roles.name')
            ->whereNotIn('name', [
                config('access.users.branch_admin_role'),
            ]);
    
        if (auth()->user()->id == 1) {
            return $roles;
        }
        
        if (auth()->user()->isAdmin() && auth()->user()->company->isDefault()) {
            return $roles->whereNotIn('name', [config('access.users.admin_role')]);
        }
        
        // if company admin belongs to central company, create all roles except the admin role
        if (auth()->user()->isCompanyAdmin()) {
            if (auth()->user()->company->is_default) {
                return $roles->whereNotIn('name', [
                    config('access.users.admin_role'),
                    config('access.users.company_admin_role'),
                ]);
            } else {
                // else do not create roles equal or higher
                return $roles->whereNotIn('name', [
                    config('access.users.guest_role'),
                    config('access.users.admin_role'),
                    config('access.users.company_admin_role'),
                ]);
            }
        }
        
        if (auth()->user()->isBranchAdmin()) {
            return $roles->whereNotIn('name', [
                config('access.users.guest_role'),
                config('access.users.admin_role'),
                config('access.users.company_admin_role'),
                config('access.users.branch_admin_role'),
            ]);
        }
        
    }
    
    /**
     * @param $name
     *
     * @return bool
     */
    protected function roleExists($name) : bool
    {
        return $this->model
                ->where('name', strtolower($name))
                ->count() > 0;
    }
}
