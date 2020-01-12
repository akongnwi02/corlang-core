<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/12/20
 * Time: 10:55 PM
 */


/*
 * All route names are prefixed with 'admin.company'.
 */

use App\Http\Controllers\Backend\Company\Company\CompanyController;

Route::group([
    'prefix'     => 'company',
    'as'         => 'company.',
    'namespace'  => 'Company',
], function () {

    /*
     * Company CRUD
     */
    Route::get('company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('company', [CompanyController::class, 'store'])->name('company.store');

    /*
     * Specific Company
     */
    Route::group(['prefix' => 'company/{uuid}'], function () {
        Route::get('/', [CompanyController::class, 'show'])->name('company.show');
    });

});
