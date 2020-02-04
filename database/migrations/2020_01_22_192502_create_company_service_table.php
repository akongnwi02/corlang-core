<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_service', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('company_id');
            $table->uuid('service_id');
            $table->boolean('is_active')->default(true);
            $table->double('company_rate')->nullable();
            $table->double('agent_rate')->nullable();
    
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
    
            $table->unique(['company_id', 'service_id']);
            $table->foreign('company_id')->references('uuid')->on('companies');
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
        Schema::dropIfExists('company_service');
    }
}
