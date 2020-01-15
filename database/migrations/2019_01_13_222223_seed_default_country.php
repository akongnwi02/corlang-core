<?php

use Illuminate\Database\Migrations\Migration;

class SeedDefaultCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('countries')->insert([
            'uuid' => Uuid::generate(4)->string,
            'name' => config('business.system.country.name.cameroon'),
            'code' => config('business.system.country.code.cameroon'),
            'is_default' => true,
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
