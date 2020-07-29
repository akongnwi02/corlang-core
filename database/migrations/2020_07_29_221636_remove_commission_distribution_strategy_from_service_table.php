<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCommissionDistributionStrategyFromServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['company_rate', 'agent_rate', 'external_rate']);
            $table->uuid('commission_distribution_id')->nullable();
        
            $table->foreign('commission_distribution_id')->references('uuid')->on('commission_distributions');
        });
    
        Schema::table('company_service', function (Blueprint $table) {
            $table->dropColumn(['company_rate', 'agent_rate', 'external_rate']);
            $table->uuid('commission_distribution_id')->nullable();
        
            $table->foreign('commission_distribution_id')->references('uuid')->on('commission_distributions');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
