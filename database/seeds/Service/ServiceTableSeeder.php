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
            'name' => 'MTN Mobile Money',
            'code' => $faker->postcode,
            'country_id' => Country::first()->uuid,
            'is_active' => true,
            'category_id' => Category::first()->uuid,
            'gateway_id' => Gateway::first()->uuid,
            'customer_rate' => 0.5,
            'agent_rate' => 0.5,
            'customercommission_id' => Commission::first()->uuid,
            'providercommission_id' => Commission::first()->uuid,
        ]);
    
    }
}
