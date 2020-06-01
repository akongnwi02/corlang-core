<?php

use Illuminate\Database\Migrations\Migration;

class SeedPrepaidBillsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('categories')->insert([
            'uuid'       => Uuid::generate(4)->string,
            'name'       => 'Prepaid Bills',
            'code'       => config('business.service.category.prepaidbills.code'),
            'is_active' => true,
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
