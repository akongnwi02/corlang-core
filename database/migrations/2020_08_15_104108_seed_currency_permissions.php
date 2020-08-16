<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCurrencyPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            config('permission.permissions.read_currencies'),
            config('permission.permissions.create_currencies'),
            config('permission.permissions.update_currencies'),
            config('permission.permissions.delete_currencies'),
            config('permission.permissions.deactivate_currencies'),
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
        //
    }
}
