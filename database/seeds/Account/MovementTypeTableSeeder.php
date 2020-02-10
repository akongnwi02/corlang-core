<?php

use App\Models\Account\MovementType;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 9:29 AM
 */

class MovementTypeTableSeeder extends Seeder
{
    public function run()
    {
        MovementType::unguard();
    
        MovementType::create([
            'code' => 'DEBIT',
            'name' => config('business.movement.type.sale'),
        ]);
    
        MovementType::create([
            'code' => 'REVERSAL',
            'name' => config('business.movement.type.reversal'),
        ]);
    
        MovementType::create([
            'code' => 'DEPOSIT',
            'name' => config('business.movement.type.deposit'),
        ]);

        MovementType::create([
            'code' => 'FLOAT',
            'name' => config('business.movement.type.float'),
        ]);
    
        MovementType::reguard();
    }
}
