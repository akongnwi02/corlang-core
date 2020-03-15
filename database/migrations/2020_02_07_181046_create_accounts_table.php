<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('owner_id');
            $table->uuid('type_id');
            $table->boolean('is_active')->default(true);
            $table->string('code')->unique();
            $table->boolean('is_default')->default(false);
            $table->dateTime('previous_archived_date')->nullable();
            $table->double('previous_closing_balance')->nullable();
    
            $table->softDeletes();
            $table->timestamps();
    
            $table->foreign('type_id')->references('uuid')->on('accounttypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
