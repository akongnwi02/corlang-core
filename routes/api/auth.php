<?php
/**
 * Created by PhpStorm.
 * User: devert
 * Date: 6/7/19
 * Time: 9:18 AM
 */

/*
 * API Access Controllers
 * All route names are prefixed with 'api/auth'
 */

use App\Http\Controllers\Api\Auth\ConfirmRegistrationController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;

Route::group(['prefix' => 'auth'], function () {

   /*
    * These routes require the user to be logged in
    */
   Route::group(['middleware' => request()->hasHeader('authorization') ? 'jwt.auth' : 'auth'], function () {
       /*
        * Get current authenticated user
        */
       Route::get('me', [LoginController::class, 'me']);
       /*
        * Logout the current user
        */
       Route::get('logout', [LoginController::class, 'logout']);
   });

   /*
    * These routes does not require the user to be logged in
    */
   Route::group([], function () {

       // Registration Routes
       if (config('access.api_registration')) {
           Route::post('register', [RegisterController::class, 'register']);
       }

       // Registration Confirmation Routes
       Route::get('register/confirm/{code}', [ConfirmRegistrationController::class, 'confirm']);
       Route::get('register/confirm/resend/{uuid}', [ConfirmRegistrationController::class, 'sendConfirmationEmail']);

       // Authentication Routes
       Route::post('login', [LoginController::class, 'login']);
       Route::get('refresh', [LoginController::class, 'refresh']);
   });
});
