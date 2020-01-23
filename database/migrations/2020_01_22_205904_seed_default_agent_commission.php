<?php

use App\Models\System\Setting;
use Illuminate\Database\Migrations\Migration;

class SeedDefaultAgentCommission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::unguard();
    
        Setting::create([
            'key' => config('business.system.setting.key.default_agent_commission'),
            'value' => 1,
            'is_visible' => true,
            'description' => 'Default commission for the agent.'
        ]);
    
        Setting::reguard();
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
