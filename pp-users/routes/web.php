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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('{id}', 'UsersController@get');
        $router->put('{id}', 'UsersController@update');
        $router->delete('{id}', 'UsersController@destroy');
    });

    $router->group(['prefix' => 'types'], function () use ($router) {
        $router->get('', 'UserTypesController@index');
        $router->get('{id}', 'UserTypesController@get');
    });
});

$router->post('api/user', 'UsersController@store');