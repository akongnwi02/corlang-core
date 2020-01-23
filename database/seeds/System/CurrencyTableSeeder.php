<?php

use App\Models\System\Country;
use App\Models\System\Currency;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/22/20
 * Time: 1:53 PM
 */

class CurrencyTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        Currency::unguard();
        
        Currency::create([
            'name' => 'Francs CFA',
            'code' => 'XAF',
            'rate' => 1,
            'is_active' => true,
        ]);
        
        Country::reguard();
    
    }
}
