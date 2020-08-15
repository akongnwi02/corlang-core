<?php

use App\Http\Controllers\Backend\Administration\CurrencyController;

Route::group([
    'prefix'     => 'administration',
    'as'         => 'administration.',
    'namespace'  => 'Administration',
], function () {
    
    /*
     * Currency CRUD
     */
    Route::get('currency', [CurrencyController::class, 'index'])
        ->name('currency.index')
        ->middleware('permission:'.config('permission.permissions.read_currencies'));
    
    Route::get('currency/create', [CurrencyController::class, 'create'])
        ->name('currency.create')
        ->middleware('permission:'.config('permission.permissions.create_currencies'));
    
    Route::post('currency', [CurrencyController::class, 'store'])
        ->name('currency.store')
        ->middleware('permission:'.config('permission.permissions.create_currencies'));
    
    /*
     * Specific Currency
     */
    Route::group(['prefix' => 'currency/{currency}'], function () {
        
        Route::get('/', [CurrencyController::class, 'show'])
            ->name('currency.show')
            ->middleware('permission:'.config('permission.permissions.read_currencies'));
        
        Route::get('edit', [CurrencyController::class, 'edit'])
            ->name('currency.edit')
            ->middleware('permission:'.config('permission.permissions.update_currencies'));
        
        Route::put('/', [CurrencyController::class, 'update'])
            ->name('currency.update')
            ->middleware('permission:'.config('permission.permissions.update_currencies'));
        
        Route::delete('/', [CurrencyController::class, 'destroy'])
            ->name('currency.destroy')
            ->middleware('permission:'.config('permission.permissions.delete_currencies'));
        
        // Status
        Route::get('mark/{status}', [CurrencyController::class, 'mark'])
            ->name('currency.mark')
            ->middleware('permission:'.config('permission.permissions.deactivate_currencies'));
        
    });
    
});
