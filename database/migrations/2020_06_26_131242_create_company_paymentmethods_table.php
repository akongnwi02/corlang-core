<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPaymentmethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_paymentmethod', function (Blueprint $table) {
            $table->uuid('company_id');
            $table->uuid('paymentmethod_id');
            $table->boolean('is_active')->default(true);
            $table->uuid('providercommission_id')->nullable();
            $table->uuid('customercommission_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->unique(['company_id', 'paymentmethod_id']);
            $table->foreign('company_id')->references('uuid')->on('companies');
            $table->foreign('paymentmethod_id')->references('uuid')->on('paymentmethods');
            $table->foreign('providercommission_id')->references('uuid')->on('commissions');
            $table->foreign('customercommission_id')->references('uuid')->on('commissions');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_payment_method');
    }
}
