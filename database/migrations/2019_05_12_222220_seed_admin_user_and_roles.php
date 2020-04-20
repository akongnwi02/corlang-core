<?php

use App\Models\Auth\User;
use Illuminate\Database\Migrations\Migration;

class SeedAdminUserAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = \Spatie\Permission\Models\Permission::create(['name' => config('permission.permissions.view_backend')]);
        $adminRole = \Spatie\Permission\Models\Role::create(['name' => config('access.users.admin_role')]);
        $companyAdminRole = \Spatie\Permission\Models\Role::create(['name' => config('access.users.company_admin_role')]);
        $branchAdminRole = \Spatie\Permission\Models\Role::create(['name' => config('access.users.branch_admin_role')]);
        $agentRole = \Spatie\Permission\Models\Role::create(['name' => config('access.users.agent_role')]);
        $guestRole = \Spatie\Permission\Models\Role::create(['name' => config('access.users.guest_role')]);
    
        $adminRole->givePermissionTo($permission);
        $companyAdminRole->givePermissionTo($permission);
        $branchAdminRole->givePermissionTo($permission);

        // Add the master administrator, user id of 1agent
        User::unguard();
        $admin = User::create([
            'first_name'           => 'Administrator',
            'last_name'            => 'System',
            'email'                => 'akongnwi02@gmail.com',
            'username'             => 'admin',
            'phone'                => '653754332',
            'password'             => 'secret',
            'pincode'             => '1234',
            'confirmation_code'    => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'mail',
            'confirmed'            => true,
        ]);
        
        $system = User::create([
            'first_name'           => 'System',
            'last_name'            => 'User',
            'email'                => 'system@system.com',
            'username'             => 'system',
            'phone'                => '',
            'password'             => 'system',
            'pincode'              => '7777',
            'confirmation_code'    => '7777',
            'notification_channel' => 'mail',
            'confirmed'            => true,
        ]);
        User::reguard();
        $admin->assignRole($adminRole);

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
