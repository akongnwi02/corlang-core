<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
            'uuid'       => Uuid::generate(4)->string,
            'name'       => config('business.system.service.name'),
            'is_default' => true,
            'is_active' => true,
            'service_id' => null,
            'accountregex' => null,
            'description' => null,
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
