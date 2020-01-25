<?php

use App\Models\Business\Commission;
use App\Models\Business\Pricing;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 7:34 PM
 */
use Faker\Generator as Faker;

class PricingTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        Pricing::unguard();
        
        Pricing::create([
            'commission_id' => Commission::first()->uuid,
            'from' => 0.00,
            'to' => 100,
            'fixed' => 100,
        ]);
        
        Pricing::create([
            'commission_id' => Commission::first()->uuid,
            'from' => 100,
            'to' => 1000,
            'percentage' => 0.5,
        ]);
        
        Pricing::create([
            'commission_id' => Commission::get()[1]->uuid,
            'from' => 100,
            'to' => 1000,
            'percentage' => 0.5,
        ]);
        
        Pricing::create([
            'commission_id' => Commission::get()[1]->uuid,
            'from' => 1000,
            'to' => 1500,
            'percentage' => 0.5,
        ]);
        
        Pricing::reguard();
    }
}
