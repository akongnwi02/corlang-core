<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/12/20
 * Time: 10:55 PM
 */


/*
 * All route names are prefixed with 'admin.payout'.
 */

use App\Http\Controllers\Backend\Payout\PayoutController;

Route::group([
    'prefix'     => 'payout',
    'as'         => 'payout.',
    'namespace'  => 'Payout',
], function () {
    
    /*
     * Account RU
     */
//    Route::get('/', [DepositAccountController::class, 'index'])
//        ->name('index')
//        ->middleware('permission:'.config('permission.permissions.read_accounts'));
    
    /*
     * Specific Account
     */
    Route::group(['prefix' => '{payout}'], function () {
        
        // Status
        Route::get('mark/{status}', [PayoutController::class, 'mark'])
            ->name('mark');
    });
});
