<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('key')->unique();
            $table->boolean('is_visible')->default(false);
            $table->string('value');
            $table->float('step')->nullable();
            $table->string('description')->nullable();
            $table->string('options')->nullable();  //[{"name":"<name>","value":"<value>"}]
            $table->integer('minimum')->nullable();
            $table->integer('maximum')->nullable();
            $table->enum('type', ['TEXT', 'NUMBER', 'CHOICE', 'BOOLEAN']);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
