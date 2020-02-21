<?php

use App\Models\Account\Movement;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 9:29 AM
 */

class MovementTableSeeder extends Seeder
{
    public function run()
    {
        Movement::unguard();
        
        Movement::reguard();
    }
}
