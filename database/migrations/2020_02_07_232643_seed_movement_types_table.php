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
            'code' => 'CREDIT',
            'name' => config('business.movement.type.credit'),
        ]);

        DB::table('movementtypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'DEBIT',
            'name' => config('business.movement.type.debit'),
        ]);
        
        DB::table('movementtypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'REVERSAL',
            'name' => config('business.movement.type.reversal'),
        ]);
        
        DB::table('movementtypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'DEPOSIT',
            'name' => config('business.movement.type.deposit'),
        ]);
        
        DB::table('movementtypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'code' => 'WITHDRAWAL',
            'name' => config('business.movement.type.withdrawal'),
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
