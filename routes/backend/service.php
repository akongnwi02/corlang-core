<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/12/20
 * Time: 10:55 PM
 */


/*
 * All route names are prefixed with 'admin.services'.
 */

use App\Http\Controllers\Backend\Services\Commission\CommissionController;
use App\Http\Controllers\Backend\Services\PaymentMethod\PaymentMethodController;
use App\Http\Controllers\Backend\Services\PaymentMethod\PaymentMethodStatusController;
use App\Http\Controllers\Backend\Services\Service\ServiceController;
use App\Http\Controllers\Backend\Services\Service\ServiceStatusController;

Route::group([
    'prefix'     => 'services',
    'as'         => 'services.',
    'namespace'  => 'Services',
], function () {
    
    /*
     * Service CRUD
     */
    Route::get('service', [ServiceController::class, 'index'])
        ->name('service.index')
        ->middleware('permission:'.config('permission.permissions.read_services'));
    
    Route::get('service/create', [ServiceController::class, 'create'])
        ->name('service.create')
        ->middleware('permission:'.config('permission.permissions.create_services'));
    
    Route::post('service', [ServiceController::class, 'store'])
        ->name('service.store')
        ->middleware('permission:'.config('permission.permissions.create_services'));
    
    /*
     * Specific Service
     */
    Route::group(['prefix' => 'service/{service}'], function () {
        
        // Company
        Route::get('/', [ServiceController::class, 'show'])
            ->name('service.show')
            ->middleware('permission:'.config('permission.permissions.read_services'));
        
        Route::get('edit', [ServiceController::class, 'edit'])
            ->name('service.edit')
            ->middleware('permission:'.config('permission.permissions.update_services'));
        
        Route::put('/', [ServiceController::class, 'update'])
            ->name('service.update')
            ->middleware('permission:'.config('permission.permissions.update_services'));
        
        Route::delete('/', [ServiceController::class, 'destroy'])
            ->name('service.destroy')
            ->middleware('permission:'.config('permission.permissions.delete_services'));
        
        // Status
        Route::get('mark/{status}', [ServiceStatusController::class, 'mark'])
            ->name('service.mark')
            ->middleware('permission:'.config('permission.permissions.deactivate_services'));
    });
    
    /*
     * Commission CRUD
     */
    Route::get('commission', [CommissionController::class, 'index'])
        ->name('commission.index')
        ->middleware('permission:'.config('permission.permissions.read_commissions'));
    
    Route::get('commission/create', [CommissionController::class, 'create'])
        ->name('commission.create')
        ->middleware('permission:'.config('permission.permissions.create_commissions'));
    
    Route::post('commission', [CommissionController::class, 'store'])
        ->name('commission.store')
        ->middleware('permission:'.config('permission.permissions.create_commissions'));
    
    /*
     * Specific Commission
     */
    Route::group(['prefix' => 'commission/{commission}'], function () {
        
        // Company
        Route::get('/', [CommissionController::class, 'show'])
            ->name('commission.show')
            ->middleware('permission:'.config('permission.permissions.read_commissions'));
        
        Route::get('edit', [CommissionController::class, 'edit'])
            ->name('commission.edit')
            ->middleware('permission:'.config('permission.permissions.update_commissions'));
        
        Route::put('/', [CommissionController::class, 'update'])
            ->name('commission.update')
            ->middleware('permission:'.config('permission.permissions.update_commissions'));
        
        Route::delete('/', [CommissionController::class, 'destroy'])
            ->name('commission.destroy')
            ->middleware('permission:'.config('permission.permissions.delete_commissions'));
    });
    
    /*
     * Payment Method CRUD
     */
    Route::get('method', [PaymentMethodController::class, 'index'])
        ->name('method.index')
        ->middleware('permission:'.config('permission.permissions.read_payment_methods'));
    
    Route::get('method/create', [PaymentMethodController::class, 'create'])
        ->name('method.create')
        ->middleware('permission:'.config('permission.permissions.create_payment_methods'));

    Route::post('method', [PaymentMethodController::class, 'store'])
        ->name('method.store')
        ->middleware('permission:'.config('permission.permissions.create_payment_methods'));
    
    /*
     * Specific Payment Method
     */
    Route::group(['prefix' => 'method/{method}'], function () {
        
//        // Payment Method
//        Route::get('/', [CommissionController::class, 'show'])
//            ->name('method.show')
//            ->middleware('permission:'.config('permission.permissions.read_payment_methods'));
        
        Route::get('edit', [PaymentMethodController::class, 'edit'])
            ->name('method.edit')
            ->middleware('permission:'.config('permission.permissions.update_payment_methods'));
        
        Route::put('/', [PaymentMethodController::class, 'update'])
            ->name('method.update')
            ->middleware('permission:'.config('permission.permissions.update_payment_methods'));
        
//        Route::delete('/', [CommissionController::class, 'destroy'])
//            ->name('method.destroy')
//            ->middleware('permission:'.config('permission.permissions.deactivate_payment_methods'));
        
        // Status
        Route::get('mark/{status}', [PaymentMethodStatusController::class, 'mark'])
            ->name('method.mark')
            ->middleware('permission:'.config('permission.permissions.deactivate_payment_methods'));
    });
    
    
});
