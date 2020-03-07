<?php

/*
 * These routes require the user to be logged in with auth or jwt.auth
 * All routes are prefixed with /api
 */

use App\Http\Controllers\Api\Business\ConfigurationController;
use App\Http\Controllers\Api\Business\QuoteController;

Route::group(['middleware' => request()->hasHeader('authorization') ? 'jwt.auth' : 'auth'], function () {
    /*
     * Configuration
     */
    Route::get('configuration', [ConfigurationController::class, 'index']);
    
    /*
     * Quote
     */
    Route::post('quote', [QuoteController::class, 'quote']);
});
