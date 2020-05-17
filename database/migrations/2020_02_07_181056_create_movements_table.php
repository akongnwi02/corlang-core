<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('code');
            $table->double('amount');
            $table->uuid('type_id');
            $table->uuid('user_id')->nullable();
            $table->uuid('company_id')->nullable();
            $table->uuid('service_id')->nullable();

            $table->uuid('currency_id');
            $table->uuid('sourceaccount_id')->nullable();
            $table->uuid('destinationaccount_id')->nullable();

            $table->boolean('is_reversed')->default(false);
            $table->boolean('is_complete')->default(false);
            $table->dateTime('reversed_at')->nullable();
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->unique(['code', 'sourceaccount_id', 'type_id']);
    
            $table->foreign('type_id')->references('uuid')->on('movementtypes');
            $table->foreign('user_id')->references('uuid')->on('users');
            $table->foreign('company_id')->references('uuid')->on('companies');
            $table->foreign('service_id')->references('uuid')->on('services');
            $table->foreign('currency_id')->references('uuid')->on('currencies');
            $table->foreign('sourceaccount_id')->references('uuid')->on('accounts');
            $table->foreign('destinationaccount_id')->references('uuid')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
