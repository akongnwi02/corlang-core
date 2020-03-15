<?php

use App\Models\Service\Category;
use App\Models\System\Gateway;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/22/20
 * Time: 1:53 PM
 */

class GatewayTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        Gateway::create([
            'category_id' => Category::first()->uuid,
            'code' => $faker->postcode,
            'name' => 'MTN Gateway via Western Union',
            'api_key' => md5($faker->uuid),
            'api_url' => $faker->url,
        ]);
    }
}
