<?php

use App\Models\Company\CompanyType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanytypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companytypes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->uuid('uuid')->unique();
            $table->string('name_en');
            $table->string('name_fr');
            $table->string('code')->unique();
            $table->timestamps();
        });
        
        CompanyType::create([
            'name_en' => 'Central Company',
            'name_fr' => 'Company Centrale',
            'code' => 'CENTRALCOMPANY'
        ]);
    }
    
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companytypes');
    }
}
