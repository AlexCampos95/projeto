<?php

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

/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->post('transaction', 'TransactionController@execute');
});

$router->post('api/externalAuth', 'ExternalAuthController@execute');
$router->post('api/updateStatus', 'UpdateStatusController@execute');
$router->post('api/check', 'CheckController@execute');