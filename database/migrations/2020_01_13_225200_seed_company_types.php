<?php

use App\Models\Company\CompanyType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
    
        CompanyType::create([
            'name' => config('business.company.type.central_company'),
            'code' => 'CENTRALCOMPANY',
        ]);
        
        CompanyType::create([
            'name' => config('business.company.type.formal_company'),
            'code' => 'FORMALCOMPANY',
        ]);
        
        CompanyType::create([
            'name' => config('business.company.type.informal_company'),
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
