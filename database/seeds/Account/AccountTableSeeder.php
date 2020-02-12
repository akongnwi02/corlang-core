<?php

use App\Models\Account\Account;
use App\Models\Account\AccountType;
use App\Models\Auth\User;
use App\Models\Company\Company;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 2/8/20
 * Time: 9:20 AM
 */

class AccountTableSeeder extends Seeder
{
    public function run()
    {
        Account::unguard();
    
        Account::create([
            'owner_id' => Company::where('is_default', true)->first()->uuid,
            'type_id' => AccountType::where('name', config('business.account.type.company'))->first()->uuid,
            'code' => '152012547',
        ]);
    
        Account::create([
            'owner_id' => User::where('id', 1)->first()->uuid,
            'type_id' => AccountType::where('name', config('business.account.type.user'))->first()->uuid,
            'code' => '152012548',
        ]);
        
        Account::reguard();
    }
}
