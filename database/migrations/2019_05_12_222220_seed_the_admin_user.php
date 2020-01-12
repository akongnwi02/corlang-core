<?php

use App\Models\Auth\User;
use Illuminate\Database\Migrations\Migration;

class SeedTheAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'view backend']);

        $role = \Spatie\Permission\Models\Role::create(['name' => config('access.users.admin_role')]);

        $role->givePermissionTo($permission);

        // Add the master administrator, user id of 1

        $admin = User::create([
            'first_name'        => 'Admin',
            'last_name'         => 'Istrator',
            'email'             => 'admin@admin.com',
            'username'          => 'admin',
            'phone'             => '653754332',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'mail',
            'confirmed'         => true,
        ]);

        $admin->assignRole($role);
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
