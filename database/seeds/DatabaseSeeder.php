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
       Model::unguard();
        
        $this->disableForeignKeys();
    
        $this->call(CompanyTableSeeder::class);
        $this->call(AuthTableSeeder::class);
    
        $this->enableForeignKeys();
    
        Model::reguard();
    }
}
