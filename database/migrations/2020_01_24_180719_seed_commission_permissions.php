<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCommissionPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            config('permission.permissions.create_commissions'),
            config('permission.permissions.read_commissions'),
            config('permission.permissions.update_commissions'),
            config('permission.permissions.delete_commissions'),
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
