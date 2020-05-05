<?php

use Illuminate\Database\Migrations\Migration;

class SeedDefaultPaymentMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('paymentmethods')->insert([
            'uuid'          => Uuid::generate(4)->string,
            'name'          => config('business.system.service.name'),
            'code'          => 'COR7487',
            'is_default'    => true,
            'is_active'     => true,
            'service_id'    => null,
            'accountregex'  => null,
            'description_en'   => 'Pay with corlang account.',
            'description_fr'   => 'Payez avec votre compte Corlang.',
        ]);
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
