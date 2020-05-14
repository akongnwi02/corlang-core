<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedReceiveMoneyCategory extends Migration
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
            'name'       => config('business.service.category.receivemoney.name'),
            'code'       => config('business.service.category.receivemoney.code'),
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
