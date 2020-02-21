<?php

use App\Models\Auth\User;
use App\Models\Business\Commission;
use App\Models\System\Currency;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 7:34 PM
 */

use Faker\Generator as Faker;

class CommissionTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        Commission::unguard();
        
        Commission::create([
            'name' => 'Default Commission',
            'description' => 'Default commission for everybody',
            'currency_id' => Currency::first()->uuid,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);
        
        Commission::create([
            'name' => 'MTN Commission',
            'description' => 'The commission applied to all merchants in MTN',
            'currency_id' => Currency::first()->uuid,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);
        
        Commission::create([
            'name' => 'Camtel Commission',
            'description' => 'The commission applied to all merchants in MTN',
            'currency_id' => Currency::first()->uuid,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);
        
        Commission::create([
            'name' => 'Orange Commission',
            'description' => 'The commission applied to all merchants in Orange Topup',
            'currency_id' => Currency::first()->uuid,
            'created_by' => User::first()->id,
            'updated_by' => User::first()->id,
        ]);
    
        Commission::reguard();
    }
}
