<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSystemCurrencyToMerchantOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->string('payment_currency_code')->nullable();
            $table->double('payment_total_amount')->nullable();
            $table->double('payment_customer_fee')->nullable();
            
            $table->foreign('payment_currency_code')->references('code')->on('currencies');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
