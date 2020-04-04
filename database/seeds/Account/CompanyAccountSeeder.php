<?php

use App\Models\Account\Account;
use App\Models\Account\AccountType;
use App\Models\Account\Strongbox;
use App\Models\Auth\User;
use App\Models\Company\Company;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 9:20 AM
 */

class CompanyAccountSeeder extends Seeder
{
    public function run()
    {
        Account::unguard();
    
        $companyWithNoAccount = Company::has('account', '=', 0)->get();
    
        foreach ($companyWithNoAccount as $company) {
            Account::create([
                'owner_id' => $company->uuid,
                'type_id' => AccountType::where('name', config('business.account.type.company'))->first()->uuid,
                'code' => Account::generateCode(),
            ]);
        }
        
        Account::reguard();
    }
}
