<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accounttypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'name' => config('business.account.type.agent'),
            'code' => 'AGENTACCOUNT',
        ]);
        
        DB::table('accounttypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'name' => config('business.account.type.company'),
            'code' => 'COMPANYACCOUNT',
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
