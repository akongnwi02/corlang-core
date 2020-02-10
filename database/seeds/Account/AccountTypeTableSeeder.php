<?php

use App\Models\Account\AccountType;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 9:21 AM
 */

class AccountTypeTableSeeder extends Seeder
{
    public function run()
    {
        AccountType::unguard();
        
        AccountType::create([
            'name' => config('business.account.type.agent'),
            'code' => 'AGENTACCOUNT',
        ]);
    
        AccountType::create([
            'name' => config('business.account.type.company'),
            'code' => 'COMPANYACCOUNT',
        ]);
        
        AccountType::reguard();
    }
}
