<?php

use App\Models\Company\Company;
use Illuminate\Database\Migrations\Migration;

class SeedStrongboxForDefaultCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('strongboxes')->insert([
            'uuid' => Uuid::generate(4)->string,
            'company_id' => Company::where('is_default', true)->first()->uuid,
            'balance' => 0,
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
