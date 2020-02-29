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
            'commissions',
            'companies',
            'company_service',
            'countries',
            'currencies',
            'pricings',
            'services',
            'settings',
            'accounts',
            'movements',
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
