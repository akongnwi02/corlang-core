<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedMovementTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('movementtypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'SALE',
            'name' => config('business.movement.type.sale'),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);
        
        DB::table('movementtypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'REVERSAL',
            'name' => config('business.movement.type.reversal'),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);
        
        DB::table('movementtypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'DEPOSIT',
            'name' => config('business.movement.type.deposit'),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);

        DB::table('movementtypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'FLOAT',
            'name' => config('business.movement.type.float'),
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
