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
            $table->integer('id')->autoIncrement();
            $table->uuid('uuid')->unique();
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->smallInteger('size')->nullable();
            $table->unsignedInteger('type_id');
            $table->unsignedBigInteger('user_owner_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();

            $table->foreign('user_owner_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('companytypes');

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
