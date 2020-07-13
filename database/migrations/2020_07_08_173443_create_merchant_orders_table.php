<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_orders', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('external_id')->unique();
            $table->string('code')->unique();
            $table->double('total_amount');
            $table->string('currency_code');
            $table->uuid('company_id');
            $table->uuid('user_id');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_email')->nullable();
            $table->uuid('paymentmethod_id')->nullable();
            $table->uuid('payment_transaction_id')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('notification_url')->nullable();
            $table->string('return_url')->nullable();
            $table->string('description')->nullable();
            
            $table->enum('status', [
                config('business.transaction.status.created'),
                config('business.transaction.status.pending'),
                config('business.transaction.status.processing'),
                config('business.transaction.status.success'),
                config('business.transaction.status.failed'),
            ])->nullable();
            
            $table->timestamps();
    
            $table->foreign('currency_code')->references('code')->on('currencies');
            $table->foreign('paymentmethod_id')->references('uuid')->on('paymentmethods');
            $table->foreign('payment_transaction_id')->references('uuid')->on('transactions');
            $table->foreign('company_id')->references('uuid')->on('companies');
            $table->foreign('user_id')->references('uuid')->on('users');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_orders');
    }
}
