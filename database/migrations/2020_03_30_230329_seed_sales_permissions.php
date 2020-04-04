<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedSalesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            config('permission.permissions.read_sales'),
        ];
    
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    
        $adminRole = \Spatie\Permission\Models\Role::findByName(config('access.users.admin_role'));
        $companyAdmin = \Spatie\Permission\Models\Role::findByName(config('access.users.company_admin_role'));
    
        $adminRole->givePermissionTo($permissions);
        $companyAdmin->givePermissionTo($permissions);
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
