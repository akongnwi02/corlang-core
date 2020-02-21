<?php

use App\Models\Account\AccountType;
use App\Models\Company\Company;
use Illuminate\Database\Migrations\Migration;

class SeedAccountForDefaultCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accounts')->insert([
            'uuid' => Uuid::generate(4)->string,
            'owner_id' => Company::where('is_default', true)->first()->uuid,
            'type_id' => AccountType::where('name', config('business.account.type.company'))->first()->uuid,
            'code' => '152012547',
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
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
