<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use DisableForeignKeys,
        TruncateTable;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateMultiple([
            'cache',
            'jobs',
            'sessions',
            'categories',
            'commissions',
            'companies',
            'company_service',
            'companytypes',
            'countries',
            'currencies',
            'pricings',
            'services',
            'settings',
            'accounttypes',
            'accounts',
            'movementtypes',
            'movements',
            'payouttypes',
            'payouts',
            'paymentmethods',
        ]);
    
        Model::unguard();
        
        $this->disableForeignKeys();
    
        $this->call(DumpTableSeeder::class);
    
        $this->enableForeignKeys();
    
        Model::reguard();
    }
}
