<?php

use App\Models\Company\Company;
use Illuminate\Database\Migrations\Migration;

class SeedCentralCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Company::create([
            'name' => 'Corlang Enterprise',
            'address' => 'Douala Bonaberi',
            'country_id' => 1,
            'street' => 'Deido',
            'state' => 'Littoral',
            'postal_code' => '00237',
            'phone' => '653754334',
            'city' => 'Douala',
            'website' => 'www.corlang.como',
            'email' => 'contact@corlang.com',
            'is_active' => true,
            'size' => 5,
            'type_id' => 1,
            'owner_id' => 1,
            'deactivated_by_id' => null,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
