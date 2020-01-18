<?php

use App\Models\Auth\User;
use Illuminate\Database\Migrations\Migration;
use App\Models\Company\Company;

class SeedAdminToCentralCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $adminUser = User::findOrFail(1);
        $adminUser->company_id = Company::firstOrFail()->uuid;
        $adminUser->update();
        
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
