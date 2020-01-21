<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->smallInteger('size')->nullable();
            $table->uuid('country_id')->nullable();
            $table->uuid('type_id');
            $table->uuid('deactivated_by_id')->nullable();
            $table->uuid('owner_id')->nullable();
            $table->string('logo_url')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('owner_id')->references('uuid')->on('users');
            $table->foreign('deactivated_by_id')->references('uuid')->on('users');
            $table->foreign('type_id')->references('uuid')->on('companytypes');
            $table->foreign('country_id')->references('uuid')->on('countries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
