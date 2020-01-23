<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/21/20
 * Time: 1:09 PM
 */

use App\Models\Company\Company;
use App\Models\Company\CompanyType;
use App\Models\System\Country;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        
        Company::unguard();
        
        Company::create([
            'name' => 'Corlang Entreprise',
            'address' => $faker->address,
            'country_id' => Country::first()->uuid,
            'street' => $faker->streetAddress,
            'state' => $faker->city,
            'postal_code' => $faker->postcode,
            'phone' => $faker->numberBetween(600000000,699999999),
            'city' => $faker->city,
            'website' => $faker->url,
            'email' => $faker->companyEmail,
            'is_active' => true,
            'is_default' => true,
            'size' => $faker->randomDigit,
            'type_id' => CompanyType::first()->uuid,
            'owner_id' => null,
            'deactivated_by_id' => null,
            'logo_url' => $faker->imageUrl(),
        ]);
        
        Company::create([
            'name' => $faker->name,
            'address' => $faker->address,
            'country_id' => Country::first()->uuid,
            'street' => $faker->streetAddress,
            'state' => $faker->city,
            'postal_code' => $faker->postcode,
            'phone' => $faker->numberBetween(600000000,699999999),
            'city' => $faker->city,
            'website' => $faker->url,
            'email' => $faker->companyEmail,
            'is_active' => true,
            'is_default' => false,
            'size' => $faker->randomDigit,
            'type_id' => CompanyType::first()->uuid,
            'owner_id' => null,
            'deactivated_by_id' => null,
            'logo_url' => $faker->imageUrl(),
        ]);
        
        Company::create([
            'name' => $faker->name,
            'address' => $faker->address,
            'country_id' => Country::first()->uuid,
            'street' => $faker->streetAddress,
            'state' => $faker->city,
            'postal_code' => $faker->postcode,
            'phone' => $faker->numberBetween(600000000,699999999),
            'city' => $faker->city,
            'website' => $faker->url,
            'email' => $faker->companyEmail,
            'is_active' => true,
            'is_default' => false,
            'size' => $faker->randomDigit,
            'type_id' => CompanyType::first()->uuid,
            'owner_id' => null,
            'deactivated_by_id' => null,
            'logo_url' => $faker->imageUrl(),
        ]);
        
        Company::create([
            'name' => $faker->name,
            'address' => $faker->address,
            'country_id' => Country::first()->uuid,
            'street' => $faker->streetAddress,
            'state' => $faker->city,
            'postal_code' => $faker->postcode,
            'phone' => $faker->numberBetween(600000000,699999999),
            'city' => $faker->city,
            'website' => $faker->url,
            'email' => $faker->companyEmail,
            'is_active' => true,
            'is_default' => false,
            'size' => $faker->randomDigit,
            'type_id' => CompanyType::first()->uuid,
            'owner_id' => null,
            'deactivated_by_id' => null,
            'logo_url' => $faker->imageUrl(),
        ]);
        
        Company::create([
            'name' => $faker->name,
            'address' => $faker->address,
            'country_id' => Country::first()->uuid,
            'street' => $faker->streetAddress,
            'state' => $faker->city,
            'postal_code' => $faker->postcode,
            'phone' => $faker->numberBetween(600000000,699999999),
            'city' => $faker->city,
            'website' => $faker->url,
            'email' => $faker->companyEmail,
            'is_active' => true,
            'is_default' => false,
            'size' => $faker->randomDigit,
            'type_id' => CompanyType::first()->uuid,
            'owner_id' => null,
            'deactivated_by_id' => null,
            'logo_url' => $faker->imageUrl(),
        ]);
    
        Company::reguard();
    
    }
}
