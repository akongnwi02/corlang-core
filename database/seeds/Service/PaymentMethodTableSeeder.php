<?php

use App\Models\Service\PaymentMethod;
use App\Models\Service\Service;
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
            'name'               => 'Orange',
            'code'               => 'ORANGE7487',
            'is_default'         => false,
            'is_active'          => true,
            'is_payment_service' => true,
            'service_id'         => Service::first()->uuid,
            'accountregex'       => null,
            'description_en'     => 'Orange Money Payment. Dial *154# to receive a code to continue',
            'description_fr'     => 'Paiement par Orange. Composez *154# pour continuer',
            'has_reference'      => true,
        ]);
        
        PaymentMethod::create([
            'name'               => config('business.system.service.name'),
            'code'               => 'COR7487',
            'is_default'         => true,
            'is_active'          => true,
            'is_payment_service' => true,
            'has_reference'      => true,
            'service_id'         => null,
            'accountregex'       => null,
            'description_en'     => 'Pay with corlang account',
            'description_fr'     => 'Payez avec votre compte Corlang',
        ]);
        
        PaymentMethod::create([
            'name'               => 'UBA',
            'code'               => 'UBA0125',
            'is_default'         => false,
            'is_active'          => true,
            'has_reference'      => true,
            'is_payment_service' => false,
            'service_id'         => null,
            'accountregex'       => null,
            'description_en'     => 'Pay with corlang account',
            'description_fr'     => 'Payez avec votre compte Corlang',
        ]);
        
        PaymentMethod::reguard();
    }
}
