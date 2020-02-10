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

use App\Http\Controllers\Backend\Account\AccountController;
use App\Http\Controllers\Backend\Account\AccountStatusController;

Route::group([
    'prefix'     => 'account',
    'as'         => 'account.',
    'namespace'  => 'Account',
], function () {
    
    /*
     * Account RU
     */
//    Route::get('/', [ServiceController::class, 'index'])
//        ->name('account.index')
//        ->middleware('permission:'.config('permission.permissions.read_accounts'));
    
    /*
     * Specific Account
     */
    Route::group(['prefix' => '{account}'], function () {
    
//        // Company
//        Route::get('/', [ServiceController::class, 'show'])
//            ->name('show')
//            ->middleware('permission:'.config('permission.permissions.read_services'));
//
//        Route::get('edit', [ServiceController::class, 'edit'])
//            ->name('edit')
//            ->middleware('permission:'.config('permission.permissions.update_services'));
//
//        Route::patch('/credit', [AccountController::class, 'credit'])
//            ->name('credit')
//            ->middleware('permission:'.config('permission.permissions.credit_accounts'));
//
//        Route::patch('/debit', [AccountController::class, 'debit'])
//            ->name('debit')
//            ->middleware('permission:'.config('permission.permissions.debit_accounts'));
        
        Route::patch('/float', [AccountController::class, 'float'])
            ->name('float')
            ->middleware('permission:'.config('permission.permissions.float_accounts'));
        
        // Status
        Route::get('mark/{status}', [AccountStatusController::class, 'mark'])
            ->name('mark')
            ->middleware('permission:'.config('permission.permissions.freeze_accounts'));
    });
});
