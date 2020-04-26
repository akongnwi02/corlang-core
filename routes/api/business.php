<?php

/*
 * All routes are prefixed with /api
 */

use App\Http\Controllers\Api\Business\AccountController;
use App\Http\Controllers\Api\Business\CallbackController;
use App\Http\Controllers\Api\Business\ConfigurationController;
use App\Http\Controllers\Api\Business\PayoutController;
use App\Http\Controllers\Api\Business\TransactionController;

/*
 * These routes require the user to be logged in with auth or jwt.auth
 */
Route::group(['middleware' => request()->hasHeader('authorization') ? 'jwt.auth' : 'auth'], function () {
    /*
     * Configuration
     */
    Route::get('configuration', [ConfigurationController::class, 'index']);

    /*
     * Quote
     */
    Route::post('quote', [TransactionController::class, 'quote']);
    
    /*
     * Pay
     */
    Route::post('confirm', [TransactionController::class, 'confirm']);
    
    /*
     * Transaction
     */
    Route::get('transaction', [TransactionController::class, 'index']);
    
    /*
     * Payout
     */
    Route::post('payout', [PayoutController::class, 'store']);
    Route::get('payout', [PayoutController::class, 'index']);
    // Specific Payout
    Route::group(['prefix' => 'payout/{payout}'], function () {
        Route::patch('/cancel', [PayoutController::class, 'cancel']);
    });
    
    /*
     * Account
     */
    Route::get('account', [AccountController::class, 'account']);
    
    /*
     * Transaction
     */
    Route::get('transaction', [TransactionController::class, 'index']);
    // Specific Transaction
    Route::group(['prefix' => 'transaction/{transaction}'], function () {
        Route::get('/', [TransactionController::class, 'show']);
    });
});

/*
 * These routes do not require any authentication
 */
Route::group(['namespace' => 'Public'], function () {
    /*
     * Callback
     */
    Route::patch('callback/{transaction}', [CallbackController::class, 'callback']);
});
