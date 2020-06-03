<?php

/*
 * All route names are prefixed with 'admin.accounting'.
 */
use App\Http\Controllers\Backend\Accounting\Collection\CollectionController;
use App\Http\Controllers\Backend\Accounting\Provision\ProvisionController;

Route::group([
    'prefix'     => 'accounting',
    'as'         => 'accounting.',
    'namespace'  => 'Accounting',
], function () {
    
    /*
     * Collection
     */
    Route::get('/collection', [CollectionController::class, 'index'])
        ->name('collection.index')
        ->middleware('permission:'.config('permission.permissions.read_accounting'));

    Route::group(['prefix' => 'collection/{service}'], function () {
        
        Route::get('/show', [CollectionController::class, 'show'])
            ->name('collection.show')
            ->middleware('permission:'.config('permission.permissions.read_accounting'));
        
        Route::patch('/pay', [CollectionController::class, 'pay'])
            ->name('collection.pay')
            ->middleware('permission:'.config('permission.permissions.pay_collection'));
    });
    
    /*
     * Provision
     */
    Route::get('/provision', [ProvisionController::class, 'index'])
        ->name('provision.index')
        ->middleware('permission:'.config('permission.permissions.read_accounting'));
    
    Route::group(['prefix' => 'provision/{service}'], function () {
        
        Route::get('/show', [ProvisionController::class, 'show'])
            ->name('provision.show')
            ->middleware('permission:'.config('permission.permissions.read_accounting'));
        
        Route::patch('/request', [ProvisionController::class, 'request'])
            ->name('provision.request')
            ->middleware('permission:'.config('permission.permissions.request_provision'));
    });
});
