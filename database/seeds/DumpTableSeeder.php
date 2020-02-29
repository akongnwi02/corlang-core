<?php

use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 8:17 PM
 */

class DumpTableSeeder extends Seeder
{
    use TruncateTable;
    
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(CommissionTableSeeder::class);
        $this->call(PricingTableSeeder::class);
        $this->call(GatewayTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(CompanyServiceTableSeeder::class);
        $this->call(AccountTableSeeder::class);
        $this->call(MovementTableSeeder::class);
        $this->call(UserAccountSeeder::class);
        $this->call(CompanyAccountSeeder::class);
        $this->call(PaymentMethodTableSeeder::class);
    }
}
