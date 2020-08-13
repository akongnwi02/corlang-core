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
            'is_default' => true,
        ]);
        
        Currency::create([
            'name' => 'United State Dollar',
            'code' => 'USD',
            'rate' => 550,
            'is_active' => true,
            'is_default' => false,
        ]);
        
        Currency::create([
            'name' => 'European Euro',
            'code' => 'EUR',
            'rate' => 650,
            'is_active' => true,
            'is_default' => false,
        ]);
        
        Country::reguard();
    
    }
}
