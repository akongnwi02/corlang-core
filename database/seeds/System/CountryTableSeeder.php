<?php

use App\Models\System\Country;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/22/20
 * Time: 1:53 PM
 */

class CountryTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        Country::unguard();
        
        Country::create([
            'name' => $faker->country,
            'code' => $faker->countryCode,
            'is_active' => true,
        ]);
        
        Country::create([
            'name' => $faker->country,
            'code' => $faker->countryCode,
            'is_active' => true,
        ]);
        
        Country::create([
            'name' => $faker->country,
            'code' => $faker->countryCode,
            'is_active' => true,
        ]);
        
        Country::create([
            'name' => $faker->country,
            'code' => $faker->countryCode,
            'is_active' => true,
        ]);
        
        Country::create([
            'name' => $faker->country,
            'code' => $faker->countryCode,
            'is_active' => true,
        ]);
        
        Country::reguard();
    
    }
}
