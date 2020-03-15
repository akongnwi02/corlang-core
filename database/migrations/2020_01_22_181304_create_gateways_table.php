<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('category_id');
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->string('api_key')->nullable();
            $table->string('api_url')->nullable();
    
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
    
            $table->foreign('category_id')->references('uuid')->on('categories');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateways');
    }
}
