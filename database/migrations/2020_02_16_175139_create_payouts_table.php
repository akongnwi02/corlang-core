<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('code')->unique();
            $table->enum('status', ['pending', 'approved', 'rejected', 'canceled'])->nullable();
            $table->double('amount');
            $table->uuid('account_id')->nullable();
            $table->uuid('type_id');
            $table->uuid('user_id')->nullable();
            $table->uuid('company_id')->nullable();
            $table->string('comment')->nullable();
            $table->uuid('currency_id');
    
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('type_id')->references('uuid')->on('payouttypes');
            $table->foreign('user_id')->references('uuid')->on('users');
            $table->foreign('company_id')->references('uuid')->on('companies');
            $table->foreign('currency_id')->references('uuid')->on('currencies');
            $table->foreign('account_id')->references('uuid')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payouts');
    }
}
