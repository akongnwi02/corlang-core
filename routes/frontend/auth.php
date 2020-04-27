<?php

use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\UpdatePinController;
use App\Http\Controllers\Frontend\Auth\SocialLoginController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\ConfirmAccountController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\UpdatePasswordController;
use App\Http\Controllers\Frontend\Auth\PasswordExpiredController;

/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.auth'.
 */
Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {

    /*
    * These routes require the user to be logged in
    */
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        //For when admin is logged in as user from backend
        Route::get('logout-as', [LoginController::class, 'logoutAs'])->name('logout-as');

        // These routes can not be hit if the password is expired
        Route::group(['middleware' => 'password_expires'], function () {
            // Change Password Routes
            Route::patch('password/update', [UpdatePasswordController::class, 'update'])->name('password.update');
        });
    
        Route::patch('pin/update', [UpdatePinController::class, 'update'])->name('pin.update');
        Route::patch('pin/create', [UpdatePinController::class, 'create'])->name('pin.create');

        // Password expired routes
        if (is_numeric(config('access.users.password_expires_days'))) {
            Route::get('password/expired', [PasswordExpiredController::class, 'expired'])->name('password.expired');
            Route::patch('password/expired', [PasswordExpiredController::class, 'update'])->name('password.expired.update');
        }
    });

    /*
     * These routes require no user to be logged in
     */
    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');

        // Socialite Routes
        Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('social.login');
        Route::get('login/{provider}/callback', [SocialLoginController::class, 'login']);

        // Registration Routes
        if (config('access.registration')) {
            Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
            Route::post('register', [RegisterController::class, 'register'])->name('register.post');
        }

        Route::post('account/confirm/{uuid}', [ConfirmAccountController::class, 'confirm'])->name('account.confirm');
        Route::get('account/confirm/{uuid}', [ConfirmAccountController::class, 'showConfirmationForm'])->name('confirm');
        Route::get('account/confirm/resend/{uuid}', [ConfirmAccountController::class, 'sendConfirmationCode'])->name('account.confirm.resend');

        // Password Reset Routes
        Route::get('password/reset/init', [ForgotPasswordController::class, 'showPasswordResetRequestForm'])->name('password.reset.init.form');
        Route::post('password/reset/init', [ForgotPasswordController::class, 'initiatePasswordReset'])->name('password.reset.init.initiate');
        Route::get('password/code/send/{uuid}', [ForgotPasswordController::class, 'sendPasswordResetCode'])->name('password.reset.code.send');
        Route::get('password/code/confirm/{uuid}', [ForgotPasswordController::class, 'showPasswordRestCodeForm'])->name('password.reset.code.form');
        Route::post('password/code/confirm/{uuid}', [ForgotPasswordController::class, 'confirmPasswordResetCode'])->name('password.reset.code.confirm');

        Route::get('password/reset/{uuid}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('password/reset/{uuid}', [ResetPasswordController::class, 'reset'])->name('password.reset');
    });
});
