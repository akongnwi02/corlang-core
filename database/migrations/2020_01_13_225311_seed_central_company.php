<?php

use App\Models\Auth\User;
use App\Models\Company\Company;
use App\Models\Company\CompanyType;
use App\Models\System\Country;
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
            'country_id' => Country::where('is_default', true)->firstOrFail()->uuid,
            'street' => 'Deido',
            'state' => 'Littoral',
            'postal_code' => '00237',
            'phone' => '653754334',
            'city' => 'Douala',
            'website' => 'www.corlang.como',
            'email' => 'contact@corlang.com',
            'is_active' => true,
            'size' => 5,
            'type_id' => CompanyType::where('name', config('business.company.type.central'))->firstOrFail()->uuid,
            'owner_id' => User::where('id', 1)->firstOrFail()->uuid,
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
