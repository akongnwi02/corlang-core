<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPayoutTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('payouttypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'COMMISSION',
            'name' => config('business.payout.type.commission'),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);
    
        DB::table('payouttypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'DRAIN',
            'name' => config('business.payout.type.drain'),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
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
