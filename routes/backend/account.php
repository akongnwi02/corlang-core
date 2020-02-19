<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/12/20
 * Time: 10:55 PM
 */


/*
 * All route names are prefixed with 'admin.account'.
 */

use App\Http\Controllers\Backend\Account\DepositAccountController;
use App\Http\Controllers\Backend\Account\AccountStatusController;
use App\Http\Controllers\Backend\Account\UmbrellaAccountController;
use App\Http\Controllers\Backend\Account\PayoutAccountController;

Route::group([
    'prefix'     => 'account',
    'as'         => 'account.',
    'namespace'  => 'Account',
], function () {
    
    /*
     * Account RU
     */
    Route::get('/deposit', [DepositAccountController::class, 'index'])
        ->name('deposit.index')
        ->middleware('permission:'.config('permission.permissions.read_accounts'));
    
    Route::get('/umbrella', [UmbrellaAccountController::class, 'index'])
        ->name('umbrella.index')
        ->middleware('permission:'.config('permission.permissions.read_accounts'));
        
    Route::get('/payout', [PayoutAccountController::class, 'index'])
        ->name('payout.index')
        ->middleware('permission:'.config('permission.permissions.read_accounts'));
    
    /*
     * Specific Account
     */
    Route::group(['prefix' => '{account}'], function () {
    
        // Account
        Route::get('/deposit', [DepositAccountController::class, 'show'])
            ->name('deposit.show')
            ->middleware('permission:'.config('permission.permissions.read_accounts'));
        
        Route::get('/umbrella', [UmbrellaAccountController::class, 'show'])
            ->name('umbrella.show')
            ->middleware('permission:'.config('permission.permissions.read_accounts'));
        
        Route::get('/payout', [PayoutAccountController::class, 'show'])
            ->name('payout.show')
            ->middleware('permission:'.config('permission.permissions.read_accounts'));

        Route::patch('/drain', [UmbrellaAccountController::class, 'drain'])
            ->name('drain')
            ->middleware('permission:'.config('permission.permissions.debit_accounts'));

        Route::patch('/credit', [DepositAccountController::class, 'credit'])
            ->name('credit')
            ->middleware('permission:'.config('permission.permissions.credit_accounts'));
        
        // to be continued when you implement the payment services
        Route::patch('/payout', [PayoutAccountController::class, 'payout'])
            ->name('payout')
            ->middleware('permission:'.config('permission.permissions.request_payouts'));
        
        Route::patch('/float', [DepositAccountController::class, 'float'])
            ->name('float')
            ->middleware('permission:'.config('permission.permissions.float_accounts'));
        
        // Status
        Route::get('mark/{status}', [AccountStatusController::class, 'mark'])
            ->name('mark')
            ->middleware('permission:'.config('permission.permissions.freeze_accounts'));
    });
    
    
});
