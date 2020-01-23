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
        $this->call(CompanyTypeTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(CommissionTableSeeder::class);
        $this->call(PricingTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(GatewayTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(CompanyServiceTableSeeder::class);
    }
}
