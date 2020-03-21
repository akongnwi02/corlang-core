<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPaymentMethodPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        $permissions = [
        config('permission.permissions.read_payment_methods'),
        config('permission.permissions.create_payment_methods'),
        config('permission.permissions.update_payment_methods'),
        config('permission.permissions.delete_payment_methods'),
        config('permission.permissions.deactivate_payment_methods'),
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
