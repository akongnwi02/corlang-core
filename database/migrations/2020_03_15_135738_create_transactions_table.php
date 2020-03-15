<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('code')->unique();
            $table->text('items')->nullable();
            $table->double('amount');
            
            $table->uuid('user_id')->nullable();
            $table->uuid('company_id')->nullable();
            $table->string('service_code')->nullable();
            $table->double('customer_fee')->nullable();
            $table->double('agent_commission')->nullable();
            $table->double('company_commission')->nullable();
            $table->double('system_commission')->nullable();
            $table->double('total_commission')->nullable();
            $table->string('currency_code');
    
            $table->string('movement_code')->nullable();
            $table->string('destination')->nullable()->comment('customer identifier');
            $table->string('paymentmethod_code')->nullable();
            $table->string('paymentaccount')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_reversed')->default(false);
            $table->dateTime('reversed_at')->nullable();
    
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('user_id')->references('uuid')->on('users');
            $table->foreign('company_id')->references('uuid')->on('companies');
            $table->foreign('service_code')->references('code')->on('services');
            $table->foreign('currency_code')->references('code')->on('currencies');
            $table->foreign('paymentmethod_code')->references('code')->on('paymentmethods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
