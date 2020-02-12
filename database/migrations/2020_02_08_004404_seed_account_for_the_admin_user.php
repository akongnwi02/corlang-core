<?php

use App\Models\Account\AccountType;
use App\Models\Auth\User;
use Illuminate\Database\Migrations\Migration;

class SeedAccountForTheAdminUser extends Migration
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
            'owner_id' => User::where('id', 1)->first()->uuid,
            'type_id' => AccountType::where('name', config('business.account.type.user'))->first()->uuid,
            'code' => '152012548',
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
