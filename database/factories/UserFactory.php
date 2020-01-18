<?php

use Faker\Generator;
use App\Models\Auth\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Generator $faker) {
    return [
        'uuid'                 => $faker->uuid,
        'first_name'           => $faker->firstName,
        'last_name'            => $faker->lastName,
        'email'                => $faker->safeEmail,
        'phone'                => $faker->phoneNumber,
        'username'             => $faker->userName,
        'notification_channel' => 'mail',
        'password'             => 'secret',
        'password_changed_at'  => null,
        'remember_token'       => str_random(10),
        'confirmation_code'    => md5(uniqid(mt_rand(), true)),
        'active'               => 1,
        'confirmed'            => 1,
    ];
});

$factory->state(User::class, 'active', function () {
    return [
        'active' => 1,
    ];
});

$factory->state(User::class, 'inactive', function () {
    return [
        'active' => 0,
    ];
});

$factory->state(User::class, 'confirmed', function () {
    return [
        'confirmed' => 1,
    ];
});

$factory->state(User::class, 'resetUnconfirmed', function () {
    return [
        'reset_confirmed' => 0,
    ];
});

$factory->state(User::class, 'resetConfirmed', function () {
    return [
        'reset_confirmed' => 1,
    ];
});

$factory->state(User::class, 'unconfirmed', function () {
    return [
        'confirmed' => 0,
    ];
});

$factory->state(User::class, 'softDeleted', function () {
    return [
        'deleted_at' => \Illuminate\Support\Carbon::now(),
    ];
});
