<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biller_payments', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('code')->unique();
            $table->double('amount');
            $table->uuid('service_id')->nullable();
            $table->uuid('type_id');
            $table->uuid('user_id')->nullable();
            $table->text('comment')->nullable();
            $table->uuid('currency_id');
    
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
    
            $table->foreign('type_id')->references('uuid')->on('payouttypes');
            $table->foreign('user_id')->references('uuid')->on('users');
            $table->foreign('service_id')->references('uuid')->on('services');
            $table->foreign('currency_id')->references('uuid')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biller_payment');
    }
}
