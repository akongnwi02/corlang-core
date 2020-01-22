<?php

use App\Http\Controllers\Backend\Auth\Role\RoleController;
use App\Http\Controllers\Backend\Auth\User\TransferUserController;
use App\Http\Controllers\Backend\Auth\User\UserController;
use App\Http\Controllers\Backend\Auth\User\UserAccessController;
use App\Http\Controllers\Backend\Auth\User\UserSocialController;
use App\Http\Controllers\Backend\Auth\User\UserStatusController;
use App\Http\Controllers\Backend\Auth\User\UserSessionController;
use App\Http\Controllers\Backend\Auth\User\UserPasswordController;
use App\Http\Controllers\Backend\Auth\User\UserConfirmationController;

/*
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
], function () {
    /*
     * User Management
     */
    Route::group(['namespace' => 'User'], function () {

        /*
         * User Status'
         */
        Route::get('user/deactivated', [UserStatusController::class, 'getDeactivated'])
            ->name('user.deactivated')
            ->middleware('permission:'.config('permission.permissions.read_users'));
    
        Route::get('user/deleted', [UserStatusController::class, 'getDeleted'])
            ->name('user.deleted')
            ->middleware('permission:'.config('permission.permissions.read_users'));

        /*
         * User CRUD
         */
        Route::get('user', [UserController::class, 'index'])
            ->name('user.index')
            ->middleware('permission:'.config('permission.permissions.read_users'));
        
        Route::get('user/create', [UserController::class, 'create'])
            ->name('user.create')
            ->middleware('permission:'.config('permission.permissions.create_users'));
        
        Route::post('user', [UserController::class, 'store'])
            ->name('user.store')
            ->middleware('permission:'.config('permission.permissions.create_users'));
    
        /*
         * Specific User
         */
        Route::group(['prefix' => 'user/{user}'], function () {
            // User
            Route::get('/', [UserController::class, 'show'])
                ->name('user.show')
                ->middleware('permission:'.config('permission.permissions.create_users'));
    
            Route::get('edit', [UserController::class, 'edit'])
                ->name('user.edit')
                ->middleware('permission:'.config('permission.permissions.update_users'));
    
            Route::patch('/', [UserController::class, 'update'])
                ->name('user.update')
                ->middleware('permission:'.config('permission.permissions.update_users'));
    
            Route::delete('/', [UserController::class, 'destroy'])
                ->name('user.destroy')
                ->middleware('permission:'.config('permission.permissions.delete_users'));
    
            // Account
            Route::get('account/confirm/resend', [UserConfirmationController::class, 'sendConfirmationEmail'])
                ->name('user.account.confirm.resend')
                ->middleware('permission:'.config('permission.permissions.deactivate_users'));
            
            // Status
            Route::get('mark/{status}', [UserStatusController::class, 'mark'])
                ->where(['status' => '[0,1]'])
                ->name('user.mark')
                ->middleware('permission:'.config('permission.permissions.deactivate_users'));
            
            // Confirmation
            Route::get('confirm', [UserConfirmationController::class, 'confirm'])
                ->name('user.confirm')
                ->middleware('permission:'.config('permission.permissions.deactivate_users'));
    
            Route::get('unconfirm', [UserConfirmationController::class, 'unconfirm'])
                ->name('user.unconfirm')
                ->middleware('permission:'.config('permission.permissions.deactivate_users'));
    
            // Password
            Route::get('password/change', [UserPasswordController::class, 'edit'])
                ->name('user.change-password')
                ->middleware('permission:'.config('permission.permissions.update_users'));
    
            Route::patch('password/change', [UserPasswordController::class, 'update'])
                ->name('user.change-password.post')
                ->middleware('permission:'.config('permission.permissions.update_users'));
    
            // Transfer
            Route::get('transfer', [TransferUserController::class, 'transfer'])
                ->name('user.transfer')
                ->middleware('permission:'.config('permission.permissions.transfer_users'));
            
            Route::patch('transfer', [TransferUserController::class, 'send'])
                ->name('user.transfer.post')
                ->middleware('permission:'.config('permission.permissions.transfer_users'));
            
            /*
             * EXCLUSIVE FOR THE SYSTEM ADMINISTRATOR
             */
            
            // Access
            Route::get('login-as', [UserAccessController::class, 'loginAs'])
                ->name('user.login-as')
                ->middleware('role:'.config('access.users.admin_role'));
            
            // Session
            Route::get('clear-session', [UserSessionController::class, 'clearSession'])
                ->name('user.clear-session')
                ->middleware('role:'.config('access.users.admin_role'));
    
            // Deleted
            Route::get('delete', [UserStatusController::class, 'delete'])
                ->name('user.delete-permanently')
                ->middleware('role:'.config('access.users.admin_role'));
    
            Route::get('restore', [UserStatusController::class, 'restore'])
                ->name('user.restore')
                ->middleware('role:'.config('access.users.admin_role'));
    
            // Social
            Route::delete('social/{social}/unlink', [UserSocialController::class, 'unlink'])
                ->name('user.social.unlink')
                ->middleware('role:'.config('access.users.admin_role'));
        });
    });

    /*
     * Role Management
     */
    Route::group(['namespace' => 'Role'], function () {
        Route::get('role', [RoleController::class, 'index'])->name('role.index');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('role', [RoleController::class, 'store'])->name('role.store');

        Route::group(['prefix' => 'role/{role}'], function () {
            Route::get('edit', [RoleController::class, 'edit'])->name('role.edit');
            Route::patch('/', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/', [RoleController::class, 'destroy'])->name('role.destroy');
        });
    });
});
