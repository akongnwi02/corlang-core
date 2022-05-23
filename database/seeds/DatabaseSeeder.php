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
        $this->disableForeignKeys();

        $this->truncateMultiple([
            'cache',
            'jobs',
            'sessions',
            'company_paymentmethod',
            'users',
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

        $this->call(DumpTableSeeder::class);

        $this->enableForeignKeys();

        Model::reguard();
    }
}
