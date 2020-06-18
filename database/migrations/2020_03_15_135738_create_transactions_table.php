<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('code')->unique();
            $table->text('items')->nullable();
            $table->string('asset')->nullable();
            $table->double('amount');
            $table->uuid('user_id')->nullable();
            $table->uuid('company_id')->nullable();
            $table->uuid('service_id')->nullable();
            $table->uuid('category_id')->nullable();
            $table->string('category_code')->nullable();
            $table->string('service_code')->nullable();
            $table->string('currency_code');
            $table->string('destination')->nullable();
            $table->string('paymentaccount')->nullable();
            $table->enum('status', [
                config('business.transaction.status.created'),
                config('business.transaction.status.pending'),
                config('business.transaction.status.processing'),
                config('business.transaction.status.verification'),
                config('business.transaction.status.success'),
                config('business.transaction.status.errored'),
                config('business.transaction.status.failed'),
                config('business.transaction.status.reversed'),
            ])->nullable();
            $table->boolean('is_account_topup')->default(false);
            $table->boolean('to_be_verified')->default(false);
            $table->string('error_code')->nullable();
            $table->text('error')->nullable();
            $table->text('message')->nullable();
    
            $table->double('customer_service_fee')->nullable();
            $table->double('provider_service_fee')->nullable();
            $table->double('total_customer_fee')->nullable();
            $table->double('total_customer_amount')->nullable();
            $table->double('total_fee')->nullable();
    
            $table->uuid('customer_servicecommission_id')->nullable();
            $table->uuid('provider_servicecommission_id')->nullable();
    
            $table->double('agent_commission')->nullable();
            $table->double('company_commission')->nullable();
            $table->double('external_commission')->nullable();
            $table->double('system_commission')->nullable();
            
            $table->string('movement_code')->nullable();
            $table->dateTime('reversed_at')->nullable();
            $table->dateTime('completed_at')->nullable();
    
            $table->string('customer_phone')->nullable();
    
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('user_id')->references('uuid')->on('users');
            $table->foreign('company_id')->references('uuid')->on('companies');
            $table->foreign('service_code')->references('code')->on('services');
            $table->foreign('service_id')->references('uuid')->on('services');
            $table->foreign('category_id')->references('uuid')->on('categories');
            $table->foreign('category_code')->references('code')->on('categories');
            $table->foreign('currency_code')->references('code')->on('currencies');
            $table->foreign('customer_servicecommission_id')->references('uuid')->on('commissions');
            $table->foreign('provider_servicecommission_id')->references('uuid')->on('commissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
