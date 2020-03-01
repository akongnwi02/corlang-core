<?php

/*
 * These routes require the user to be logged in with auth or jwt.auth
 * All routes are prefixed with jwt
 */

use App\Http\Controllers\Api\Business\CategoryController;
use App\Http\Controllers\Api\Business\CountryController;
use App\Http\Controllers\Api\Business\CurrencyController;
use App\Http\Controllers\Api\Business\PaymentMethodController;
use App\Http\Controllers\Api\Business\ServiceController;

Route::group([], function () {
    /*
     * Service
     */
    Route::get('service', [ServiceController::class, 'index']);
    
    Route::group(['prefix' => 'service/{service}'], function () {
//        Route::get('/', [ServiceController::class, 'show']);
    });
    
    /*
     * Service Category
     */
    Route::get('category', [CategoryController::class, 'index']);

    Route::group(['prefix' => 'category/{category}'], function () {
//        Route::get('/', [CategoryController::class, 'show']);
    });
    
    /*
     * Payment Method
     */
    Route::get('payment-method', [PaymentMethodController::class, 'index']);
    
    Route::group(['prefix' => 'payment-method/{method}'], function () {
//        Route::get('/', [PaymentMethodController::class, 'show']);
    });
    
    /*
     * Payment Method
     */
    Route::get('country', [CountryController::class, 'index']);
    
    Route::group(['prefix' => 'country/{country}'], function () {
//        Route::get('/', [PaymentMethodController::class, 'show']);
    });
    
    /*
     * Payment Method
     */
    Route::get('currency', [CurrencyController::class, 'index']);
    
    Route::group(['prefix' => 'currency/{currency}'], function () {
//        Route::get('/', [PaymentMethodController::class, 'show']);
    });
    
});
