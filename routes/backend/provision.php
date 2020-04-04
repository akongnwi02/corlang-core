<?php

/*
 * All route names are prefixed with 'admin.services'.
 */

use App\Http\Controllers\Backend\Provision\PaymentMethodProvisionController;
use App\Http\Controllers\Backend\Provision\ServiceProvisionController;

Route::group([
    'prefix'     => 'provision',
    'as'         => 'provision.',
    'namespace'  => 'Provision',
], function () {
    
    /*
     * Provision CRUD
     */
    Route::get('method', [PaymentMethodProvisionController::class, 'index'])
        ->name('method.index')
        ->middleware('permission:' . config('permission.permissions.read_provisions'));
    
    Route::get('service', [ServiceProvisionController::class, 'index'])
        ->name('service.index')
        ->middleware('permission:' . config('permission.permissions.read_provisions'));

});
