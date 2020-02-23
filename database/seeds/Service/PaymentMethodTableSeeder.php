<?php

use App\Models\Service\PaymentMethod;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/23/20
 * Time: 6:39 PM
 */

class PaymentMethodTableSeeder extends Seeder
{
    public function run()
    {
        PaymentMethod::unguard();
        
        PaymentMethod::create([
            'name'       => config('business.system.service.name'),
            'is_default' => true,
            'is_active' => true,
            'service_id' => null,
            'accountregex' => null,
            'description' => null,
        ]);
        
        PaymentMethod::reguard();
    }
}
