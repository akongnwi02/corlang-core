<?php

/*
 * All routes are prefixed with /api
 */

use App\Http\Controllers\Api\Business\CallbackController;
use App\Http\Controllers\Api\Business\ConfigurationController;
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
    Route::post('pay', [TransactionController::class, 'pay']);
    
});

/*
 * These routes do not require any authentication
 */
Route::group(['namespace' => 'Callback'], function () {
    /*
     * Callback
     */
    Route::post('callback', [CallbackController::class, 'callback']);
    
});
