<?php

use Illuminate\Database\Migrations\Migration;

class SeedCompanyPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            config(['permission.permissions.create_companies']),
            config(['permission.permissions.read_companies']),
            config(['permission.permissions.update_companies']),
            config(['permission.permissions.delete_companies']),
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        $adminRole = \Spatie\Permission\Models\Role::findByName(config('access.users.admin_role'));
        $companyAdminRole = \Spatie\Permission\Models\Role::findByName(config('access.users.company_admin_role'));

        $adminRole->givePermissionTo($permissions);
        $companyAdminRole->givePermissionTo([
            config(['permission.permissions.read_companies']),
            config(['permission.permissions.update_companies']),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
