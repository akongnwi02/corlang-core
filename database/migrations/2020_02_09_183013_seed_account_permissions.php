<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAccountPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            config('permission.permissions.float_accounts'),
            config('permission.permissions.credit_accounts'),
            config('permission.permissions.debit_accounts'),
            config('permission.permissions.freeze_accounts'),
            
            config('permission.permissions.transfer_money'),
            
            config('permission.permissions.request_payouts'),
            config('permission.permissions.validate_payouts'),
        ];
    
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    
        $adminRole = \Spatie\Permission\Models\Role::findByName(config('access.users.admin_role'));
        $companyAdminRole = \Spatie\Permission\Models\Role::findByName(config('access.users.company_admin_role'));
    
        $adminRole->givePermissionTo($permissions);
        $companyAdminRole->givePermissionTo([
            config('permission.permissions.credit_accounts'),
            config('permission.permissions.debit_accounts'),
            
            config('permission.permissions.request_payouts'),
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
