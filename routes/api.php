<?php


/*
 * Global Routes
 * Routes that are used by the api
 */


/*
 * API Routes
 * Namespaces indicate folder structure
 */

Log::info('Incoming Request', ['input' => request()->input(), 'path' => request()->getRequestUri(), 'headers' => request()->header()]);

Route::group(['namespace' => 'Api', 'middleware' => 'localization'], function () {
    include_route_files(__DIR__.'/api/');
});
