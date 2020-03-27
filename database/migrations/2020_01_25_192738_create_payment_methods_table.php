<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentmethods', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->uuid('service_id')->nullable();
            $table->uuid('commission_id')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('has_reference')->default(false);
            $table->string('accountregex')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->unique();
            $table->string('description_en')->nullable();
            $table->string('description_fr')->nullable();
    
            $table->foreign('commission_id')->references('uuid')->on('commissions');
            $table->foreign('service_id')->references('uuid')->on('services');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paymentmethods');
    }
}