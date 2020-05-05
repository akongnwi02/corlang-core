<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopupAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topup_accounts', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->uuid('user_id');
            $table->boolean('is_confirmed')->default(false);
            $table->uuid('paymentmethod_id');
            $table->string('account')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
    
            $table->timestamps();
    
            $table->foreign('paymentmethod_id')->references('uuid')->on('paymentmethods');
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
        Schema::dropIfExists('topup_accounts');
    }
}
