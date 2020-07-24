<?php

/*
 * These routes are for merchant integration
 */

use App\Http\Controllers\Api\Merchant\AuthController;
use App\Http\Controllers\Api\Merchant\CallbackController;
use App\Http\Controllers\Api\Merchant\PayController;
use App\Http\Controllers\Api\Merchant\V1\OrderController;

Route::group(['namespace' => 'Merchant', 'prefix' => 'merchant'], function () {
    
    // INTERNAL API DOESN'T NEED TO CHANGE
    Route::post('token', [AuthController::class, 'auth'])
        ->middleware('auth.basic:,username');
    Route::patch('pay/{order}', [PayController::class, 'pay']);
    Route::patch('callback/{order}', [CallbackController::class, 'callback']);
    
    // API VERSION 1
    Route::group(['namespace' => 'VersionOne', 'prefix' => 'v1'], function () {
        // protected routes
        Route::group(['middleware' => ['jwt.auth', 'active.confirmed']], function () {
            Route::post('order', [OrderController::class, 'order']);
            Route::get('order/{external_id}', [OrderController::class, 'show']);
            Route::delete('order/{external_id}', [OrderController::class, 'destroy']);
        });
        // public routes
        Route::get('order/{order}/link', [OrderController::class, 'link']);
    });
    
    
    Route::group(['namespace' => 'VersionTwo', 'prefix' => 'v2'], function () {
    
    });


});
