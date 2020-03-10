<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 7:19 PM
 */

use App\Models\Business\Commission;
use App\Models\Service\Category;
use App\Models\Service\Service;
use App\Models\System\Country;
use App\Models\System\Gateway;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        Service::create([
            'name' => 'Sample service 1',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => $faker->postcode,
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::first()->uuid,
            'gateway_id' => Gateway::first()->uuid,
            'company_rate' => 50,
            'agent_rate' => 50,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
        
        Service::create([
            'name' => 'Sample service 2',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => $faker->postcode,
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::first()->uuid,
            'gateway_id' => Gateway::first()->uuid,
            'company_rate' => 25,
            'agent_rate' => 30,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
        
        Service::create([
            'name' => 'Sample service 3',
            'description' => 'Some quick example text to serve as the service description and make up the bulk of the service\'s content.',
            'code' => $faker->postcode,
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::first()->uuid,
            'gateway_id' => Gateway::first()->uuid,
            'company_rate' => 45,
            'agent_rate' => 50,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
    
    }
}
