<?php

/*
 * These routes are for merchant integration
 */

use App\Http\Controllers\Api\Merchant\AuthController;
use App\Http\Controllers\Api\Merchant\V1\OrderController;

Route::group(['namespace' => 'Merchant', 'prefix' => 'merchant'], function () {
    
    Route::post('token', [AuthController::class, 'auth'])
        ->middleware('auth.basic:,username');
    
        
    Route::group(['namespace' => 'VersionOne', 'prefix' => 'v1'], function () {
        
        // protected routes
        Route::group(['middleware' => ['jwt.auth', 'active.confirmed']], function () {
            Route::post('order', [OrderController::class, 'order']);
            Route::get('order/{external_id}', [OrderController::class, 'show']);
            
        });
        // public routes
        Route::get('order/{order}/link', [OrderController::class, 'link']);
    
    });
    
    
    Route::group(['namespace' => 'VersionTwo', 'prefix' => 'v2'], function () {

    });


});
