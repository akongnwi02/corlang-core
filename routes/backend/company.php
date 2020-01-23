<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/12/20
 * Time: 10:55 PM
 */


/*
 * All route names are prefixed with 'admin.companies'.
 */

use App\Http\Controllers\Backend\Company\Company\CompanyController;
use App\Http\Controllers\Backend\Company\Company\CompanyStatusController;

Route::group([
    'prefix'     => 'companies',
    'as'         => 'companies.',
    'namespace'  => 'Companies',
], function () {
    
    /*
     * Company CRUD
     */
    Route::get('company', [CompanyController::class, 'index'])
        ->name('company.index')
        ->middleware('permission:'.config('permission.permissions.read_companies'));
    
    Route::get('company/create', [CompanyController::class, 'create'])
        ->name('company.create')
        ->middleware('permission:'.config('permission.permissions.create_companies'));

    Route::post('company', [CompanyController::class, 'store'])
        ->name('company.store')
        ->middleware('permission:'.config('permission.permissions.create_companies'));

    /*
     * Specific Company
     */
    Route::group(['prefix' => 'company/{company}'], function () {
        
        // Company
        Route::get('/', [CompanyController::class, 'show'])
            ->name('company.show')
            ->middleware('permission:'.config('permission.permissions.read_companies'));

        Route::get('edit', [CompanyController::class, 'edit'])
            ->name('company.edit')
            ->middleware('permission:'.config('permission.permissions.update_companies'));

        Route::put('/', [CompanyController::class, 'update'])
            ->name('company.update')
            ->middleware('permission:'.config('permission.permissions.update_companies'));

        Route::delete('/', [CompanyController::class, 'destroy'])
            ->name('company.destroy')
            ->middleware('permission:'.config('permission.permissions.delete_companies'));
    
        // Status
        Route::get('mark/{status}', [CompanyStatusController::class, 'mark'])
            ->where(['status' => '[0,1]'])
            ->name('company.mark')
            ->middleware('permission:'.config('permission.permissions.deactivate_companies'));
    });

});
