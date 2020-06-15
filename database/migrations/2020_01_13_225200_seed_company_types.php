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
            'name' => config('business.company.type.merchant'),
            'code' => 'MERCHANTCOMPANY',
        ]);
    
        DB::table('companytypes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'name' => config('business.company.type.internal'),
            'code' => 'INTERNALCOMPANY',
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
