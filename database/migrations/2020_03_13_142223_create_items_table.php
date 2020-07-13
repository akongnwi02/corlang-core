<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('service_id');
            $table->string('name')->unique()->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_fr')->nullable();
            $table->string('code')->nullable();
            $table->double('amount')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
        
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('service_id')->references('uuid')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
