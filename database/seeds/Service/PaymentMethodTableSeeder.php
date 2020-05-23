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
            'name'           => 'MTN',
            'code'           => 'MTN7487',
            'is_default'     => false,
            'is_active'      => true,
            'is_realtime'    => true,
            'service_id'     => Service::where('code', 'CORMTNOUT')->first()->uuid,
            'accountregex'   => null,
            'placeholder_text' => '2376xxxxxxxx',
            'description_en' => 'MTN Mobile Money payment. Dial *126# on your mobile to confirm payment',
            'description_fr' => 'Paiement par MTN Money. Composez *126# sur votre compte pour confirmer le paiement',
        ]);
        
        PaymentMethod::create([
            'name'           => 'Orange Money Top Up',
            'code'           => 'CORPAYORANGEWP',
            'is_default'     => false,
            'is_active'      => true,
            'is_realtime'    => true,
            'service_id'     => Service::where('code', 'CORORANGEWEBPAY')->first()->uuid,
            'accountregex'   => null,
            'placeholder_text' => '2376xxxxxxxx',
            'description_en' => 'Orange Money Payment. Confirm the payment with your PIN on your mobile phone.',
            'description_fr' => 'Confirmer le paiement avec votre code PIN sur votre telephone mobile.',
        ]);
        
        PaymentMethod::create([
            'name'           => config('business.system.service.name'),
            'code'           => 'COR7487',
            'is_default'     => true,
            'is_active'      => true,
            'is_realtime'    => true,
            'service_id'     => null,
            'accountregex'   => null,
            'description_en' => 'Pay with corlang account',
            'description_fr' => 'Payez avec votre compte Corlang',
        ]);
        
        PaymentMethod::create([
            'name'           => 'UBA',
            'code'           => 'UBA0125',
            'is_default'     => false,
            'is_active'      => true,
            'is_realtime'    => false,
            'service_id'     => null,
            'accountregex'   => null,
            'description_en' => 'UBA account',
            'description_fr' => 'Compte UBA',
        ]);
        
        PaymentMethod::reguard();
    }
}
