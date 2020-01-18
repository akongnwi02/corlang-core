<?php

use App\Models\Company\CompanyType;
use Illuminate\Database\Migrations\Migration;

class SeedCompanyTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('companytypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'name' => config('business.company.type.formal'),
            'code' => 'FORMALCOMPANY',
        ]);
    
        DB::table('companytypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'name' => config('business.company.type.informal'),
            'code' => 'INFORMALCOMPANY',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
    }
}
