<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedServiceBalancePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            config('permission.permissions.read_service_balance'),
            config('permission.permissions.create_service_balance'),
            config('permission.permissions.update_service_balance'),
            config('permission.permissions.delete_service_balance'),
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        $adminRole = \Spatie\Permission\Models\Role::findByName(config('access.users.admin_role'));

        $adminRole->givePermissionTo($permissions);
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
