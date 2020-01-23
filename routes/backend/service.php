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

use App\Http\Controllers\Backend\Services\Service\ServiceController;
use App\Http\Controllers\Backend\Services\Service\ServiceStatusController;

Route::group([
    'prefix'     => 'services',
    'as'         => 'services.',
    'namespace'  => 'Services',
], function () {
    
    /*
     * Company CRUD
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
     * Specific Company
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
    
});
