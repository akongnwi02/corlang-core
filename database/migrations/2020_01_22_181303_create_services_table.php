<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->boolean('is_active')->default(true);
            $table->uuid('category_id');
            $table->string('api_key')->nullable();
            $table->string('api_url')->nullable();
            $table->string('api_secret')->nullable();
            $table->uuid('agentcommission_id')->nullable();
            $table->uuid('companycommission_id')->nullable();
            $table->uuid('customercommission_id')->nullable();
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
    
            $table->foreign('agentcommission_id')->references('uuid')->on('commissions');
            $table->foreign('companycommission_id')->references('uuid')->on('commissions');
            $table->foreign('customercommission_id')->references('uuid')->on('commissions');
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
        Schema::dropIfExists('services');
    }
}
