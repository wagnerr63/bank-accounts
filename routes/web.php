<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    var_export('test  heroku');
    return $router->app->version();
});

$router->post('/reset', 'ResetController@handle');

$router->get('/balance', 'GetBalanceByNumberController@handle');

$router->post('/event', 'RegisterEventController@handle');
