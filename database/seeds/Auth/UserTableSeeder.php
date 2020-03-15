<?php

use App\Models\Auth\User;
use App\Models\Company\Company;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = User::create([
            'id'                => 1,
            'first_name'        => 'System',
            'last_name'         => 'Administrator',
            'username'          => 'admin',
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'mail',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.company_admin_role'));
        
        $user = User::create([
            'id'                => 1,
            'first_name'        => 'System',
            'last_name'         => 'User',
            'username'          => 'system',
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'system',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'mail',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.company_admin_role'));

        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.company_admin_role'));
        
        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.admin_role'));

        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.admin_role'));

        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.admin_role'));

        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.agent_role'));
        
        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.agent_role'));
        
        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.agent_role'));
        
        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => Company::first()->uuid,
        ]);
        $user->assignRole(config('access.users.agent_role'));
        
        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => null,
        ]);
        $user->assignRole(config('access.users.guest_role'));
        
        $user = User::create([
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'username'          => $faker->userName,
            'phone'             => $faker->numberBetween(600000000,699999999),
            'email'             => $faker->email,
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'notification_channel' => 'sms',
            'confirmed'         => true,
            'company_id'        => null,
        ]);
        $user->assignRole(config('access.users.guest_role'));
        
    }
}
