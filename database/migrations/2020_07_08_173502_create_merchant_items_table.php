<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_items', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->uuid('order_id');
            $table->integer('quantity')->nullable();
            $table->double('unit_cost')->nullable();
            $table->double('sub_total')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('logo_url')->nullable();
            
            $table->timestamps();
            
            $table->foreign('order_id')->references('uuid')->on('merchant_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_items');
    }
}
