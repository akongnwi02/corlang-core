<?php

use Illuminate\Database\Migrations\Migration;

class SeedPostpaidBillsCategory extends Migration
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
            'name'       => 'Postpaid Bills',
            'code'       => config('business.service.category.postpaidbills.code'),
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
