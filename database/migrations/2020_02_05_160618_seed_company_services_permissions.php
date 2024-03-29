<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCompanyServicesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            config('permission.permissions.create_company_services'),
            config('permission.permissions.update_company_services'),
            config('permission.permissions.deactivate_company_services'),
            config('permission.permissions.read_company_services'),
        ];
    
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    
        $adminRole = \Spatie\Permission\Models\Role::findByName(config('access.users.admin_role'));
        $companyAdminRole = \Spatie\Permission\Models\Role::findByName(config('access.users.company_admin_role'));
    
        $adminRole->givePermissionTo($permissions);
        
        $companyAdminRole->givePermissionTo([
            config('permission.permissions.deactivate_company_services'),
            config('permission.permissions.read_company_services'),
        ]);
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
