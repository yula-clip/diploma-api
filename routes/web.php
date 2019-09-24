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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/users', function () {
//     return \App\User::get();
// });

$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/', 'UserController@all');
    $router->get('/{id}', 'UserController@get');
    $router->post('/', 'UserController@save');
    $router->put('/{id}', 'UserController@save');
    $router->delete('/{id}', 'UserController@delete');
});

$router->post('/auth/login', 'AuthController@postLogin');
