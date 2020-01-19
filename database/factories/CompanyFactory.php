<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/18/20
 * Time: 8:13 PM
 */

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

use App\Models\Company\Company;
use Faker\Generator;
use Illuminate\Support\Str;

$factory->define(Company::class, function (Generator $faker) {
    return [
        'uuid'          => $faker->uuid,
        'name'          => $faker->name,
        'email'         => $faker->email,
        'phone'         => $faker->phoneNumber,
        'address'       => $faker->address,
        'website'       => $faker->url,
        'street'        => $faker->streetAddress,
        'city'          => $faker->city,
        'state'         => $faker->city,
        'postal_code'   => $faker->postcode,
        'country_id'    => \App\Models\System\Country::first()->uuid,
        'size'          => $faker->randomDigit,
        'type_id'       => \App\Models\Company\CompanyType::first()->uuid,
    ];
});

$factory->state(Company::class, 'inactive', function () {
    return [
        'is_active' => 0,
        'deactivated_by_id' => Uuid::generate(4)->string,
    ];
});

$factory->state(Company::class, 'active', function () {
    return [
        'is_active' => 1,
    ];
});
