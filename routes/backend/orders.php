<?php

use App\Http\Controllers\Backend\Orders\MerchantOrdersController;

Route::group([
    'prefix'     => 'orders',
    'as'         => 'orders.',
    'namespace'  => 'Orders',
], function () {
    
    /*
     * Provision CRUD
     */
    Route::get('/', [MerchantOrdersController::class, 'index'])
        ->name('index')
        ->middleware('permission:' . config('permission.permissions.read_sales'));
//
//    Route::get('/download', [MerchantOrdersController::class, 'download'])
//        ->name('download')
//        ->middleware('permission:' . config('permission.permissions.read_sales'));
});
