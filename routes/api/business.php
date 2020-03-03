<?php

/*
 * These routes require the user to be logged in with auth or jwt.auth
 * All routes are prefixed with jwt
 */

use App\Http\Controllers\Api\Business\ConfigurationController;

Route::group(['middleware' => request()->hasHeader('authorization') ? 'jwt.auth' : 'auth'], function () {
    /*
     * Configuration
     */
    Route::get('configuration', [ConfigurationController::class, 'index']);
    
});
