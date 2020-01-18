<?php

namespace Tests;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase.
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create the admin role or return it if it already exists.
     *
     * @return mixed
     */
    protected function getAdminRole()
    {
        if ($role = Role::whereName(config('access.users.admin_role'))->first()) {
            return $role;
        }

        $adminRole = factory(Role::class)->create(['name' => config('access.users.admin_role')]);
        $adminRole->givePermissionTo(factory(Permission::class)->create(['name' => 'view backend']));

        return $adminRole;
    }

    /**
     * Create the admin role or return it if it already exists.
     *
     * @return mixed
     */
    protected function getCompanyAdminRole()
    {
        if ($role = Role::whereName(config('access.users.company_admin_role'))->first()) {
            return $role;
        }

        $companyAdminRole = factory(Role::class)->create(['name' => config('access.users.company_admin_role')]);
        $companyAdminRole->givePermissionTo(factory(Permission::class)->create(['name' => 'view backend']));

        return $companyAdminRole;
    }

    /**
     * Create an administrator.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    protected function createAdmin(array $attributes = [])
    {
        $adminRole = $this->getAdminRole();
        $admin = factory(User::class)->create($attributes);
        $admin->assignRole($adminRole);

        return $admin;
    }
    
    /**
     * Create a company administrator.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    protected function createCompanyAdmin(array $attributes = [])
    {
        $companyAdminRole = $this->getCompanyAdminRole();
        $companAdmin = factory(User::class)->create($attributes);
        $companAdmin->assignRole($companyAdminRole);

        return $companAdmin;
    }

    /**
     * Login the given administrator or create the first if none supplied.
     *
     * @param bool $admin
     *
     * @return bool|mixed
     */
    protected function loginAsAdmin($admin = false)
    {
        if (! $admin) {
            $admin = $this->createAdmin();
        }

        $this->be($admin);

        return $admin;
    }
    
    /**
     * Login the given company administrator or create the first if none supplied.
     *
     * @param bool $companyAdmin
     * @return bool|mixed
     */
    protected function loginAsCompanyAdmin($companyAdmin = false)
    {
        if (! $companyAdmin) {
            $companyAdmin = $this->createCompanyAdmin();
        }

        $this->actingAs($companyAdmin);

        return $companyAdmin;
    }
}
