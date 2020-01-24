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
            $table->uuid('uuid')->primary();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->boolean('is_active')->default(true);
            $table->string('logo_url')->default(true);
            $table->uuid('gateway_id')->nullable();
            $table->uuid('category_id');
            $table->uuid('providercommission_id')->nullable();
            $table->uuid('companycommission_id')->nullable();
            $table->uuid('customercommission_id')->nullable();
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
    
            $table->foreign('providercommission_id')->references('uuid')->on('commissions');
            $table->foreign('companycommission_id')->references('uuid')->on('commissions');
            $table->foreign('customercommission_id')->references('uuid')->on('commissions');
            $table->foreign('category_id')->references('uuid')->on('categories');
            $table->foreign('gateway_id')->references('uuid')->on('gateways');
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
