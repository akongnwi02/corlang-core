<?php


/*
 * Global Routes
 * Routes that are used by the api
 */


/*
 * API Routes
 * Namespaces indicate folder structure
 */

Route::group(['namespace' => 'Api', 'middleware' => 'localization'], function () {
    include_route_files(__DIR__.'/api/');
});
