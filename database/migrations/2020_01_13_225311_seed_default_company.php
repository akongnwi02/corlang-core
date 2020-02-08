<?php

use App\Models\Auth\User;
use App\Models\Company\CompanyType;
use App\Models\System\Country;
use Illuminate\Database\Migrations\Migration;

class SeedDefaultCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('companies')->insert([
            'uuid'              => Uuid::generate(4)->string,
            'name'              => 'Corlang Enterprise',
            'address'           => 'Douala Bonaberi',
            'country_id'        => Country::where('is_default', true)->firstOrFail()->uuid,
            'street'            => 'Deido',
            'state'             => 'Littoral',
            'postal_code'       => '00237',
            'phone'             => '653754334',
            'city'              => 'Douala',
            'website'           => 'www.corlang.como',
            'email'             => 'contact@corlang.com',
            'is_active'         => true,
            'is_default'        => true,
            'size'              => 5,
            'type_id'           => CompanyType::where('name', config('business.company.type.formal'))->firstOrFail()->uuid,
            'owner_id'          => User::find(1)->uuid,
            'deactivated_by_id' => null,
            'logo_url'          => null,
            'created_at'        => now()->toDateTimeString(),
            'updated_at'        => now()->toDateTimeString(),
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
