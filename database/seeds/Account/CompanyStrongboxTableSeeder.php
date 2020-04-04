<?php

use App\Models\Account\Strongbox;
use App\Models\Company\Company;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 4/3/20
 * Time: 2:16 AM
 */

class CompanyStrongboxTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        Strongbox::unguard();
        
        $companyWithNoStrongbox = Company::has('strongbox', '=', 0)->get();
        
        foreach ($companyWithNoStrongbox as $company) {
            Strongbox::create([
                'balance' => 0,
                'company_id' => $company->uuid,
            ]);
        }
        
        Strongbox::reguard();
    }
}
