<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/7/19
 * Time: 9:18 AM
 */

/*
 * API Access Controllers
 * All route names are prefixed with 'api.auth'
 */

use App\Http\Controllers\Api\Auth\ConfirmRegistrationController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {

   /*
    * These routes require the user to be logged in
    */
   Route::group(['middleware' => 'jwt'], function () {

   });

   /*
    * These routes does not require the user to be logged in
    */
   Route::group([], function () {

       // Registration Routes
       if (config('access.api_registration')) {
           Route::post('register', [RegisterController::class, 'register'])->name('register');
       }

       // Registration Confirmation Routes
       Route::get('register/confirm/{code}', [ConfirmRegistrationController::class, 'confirm'])->name('register.confirm');
       Route::get('register/confirm/resend/{uuid}', [ConfirmRegistrationController::class, 'sendConfirmationEmail'])->name('register.confirm.resend.email');

       // Authentication Routes
       Route::post('login', [LoginController::class, 'login'])->name('login');
   });
});