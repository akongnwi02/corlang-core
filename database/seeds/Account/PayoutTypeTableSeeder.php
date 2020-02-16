<?php

use App\Models\Account\PayoutType;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/16/20
 * Time: 7:10 PM
 */

class PayoutTypeTableSeeder extends Seeder
{
    public function run()
    {
        PayoutType::unguard();
        
        PayoutType::create([
            'code' => 'COMMISSION',
            'name' => config('business.payout.type.commission'),
        ]);
        
        PayoutType::create([
            'code' => 'DRAIN',
            'name' => config('business.payout.type.drain'),
        ]);
        
        PayoutType::reguard();
    }
    
}
