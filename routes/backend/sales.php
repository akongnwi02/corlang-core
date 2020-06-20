<?php

use App\Http\Controllers\Backend\Sales\SalesController;

Route::group([
    'prefix'     => 'sales',
    'as'         => 'sales.',
    'namespace'  => 'Sales',
], function () {
    
    /*
     * Provision CRUD
     */
    Route::get('/', [SalesController::class, 'index'])
        ->name('index')
        ->middleware('permission:' . config('permission.permissions.read_sales'));
    
    Route::get('/download', [SalesController::class, 'download'])
        ->name('download')
        ->middleware('permission:' . config('permission.permissions.read_sales'));
});
