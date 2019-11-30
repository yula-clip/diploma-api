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

$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/', 'UserController@all');
    $router->get('/{id}', 'UserController@get');
    $router->post('/', 'UserController@save');
    $router->put('/{id}', 'UserController@save');
    $router->delete('/{id}', 'UserController@delete');
});

$router->group(['prefix' => 'rivers'], function () use ($router) {
    $router->get('/', 'RiverController@all');
    $router->get('/{id}', 'RiverController@get');
    $router->post('/', 'RiverController@save');
    $router->put('/{id}', 'RiverController@save');
    $router->delete('/{id}', 'RiverController@delete');
});

$router->group(['prefix' => 'riverSections'], function () use ($router) {
    $router->get('/', 'RiverSectionController@all');
    $router->get('/{id}', 'RiverSectionController@get');
    $router->post('/', 'RiverSectionController@save');
    $router->put('/{id}', 'RiverSectionController@save');
    $router->delete('/{id}', 'RiverSectionController@delete');
});

$router->group(['prefix' => 'measuringPoints'], function () use ($router) {
    $router->get('/', 'MeasuringPointController@all');
    $router->get('/{id}', 'MeasuringPointController@get');
    $router->post('/', 'MeasuringPointController@save');
    $router->put('/{id}', 'MeasuringPointController@save');
    $router->delete('/{id}', 'MeasuringPointController@delete');
});

$router->group(['prefix' => 'realMeasures'], function () use ($router) {
    $router->get('/', 'MeasureController@all');
    $router->get('/polluted', 'MeasureController@getPollutedSection');
    $router->get('/import', 'MeasureController@importMeasures');
    $router->get('/{id}', 'MeasureController@get');
    $router->get('/{id}/sectionId', 'MeasureController@getMeasures');
    $router->get('/{id}/results', 'MeasureController@getResults');
    $router->post('/', 'MeasureController@save');
    $router->put('/{id}', 'MeasureController@save');
    $router->delete('/{id}', 'MeasureController@delete');
});

$router->group(['prefix' => 'substances'], function () use ($router) {
    $router->get('/', 'SubstanceController@all');
    $router->get('/{id}', 'SubstanceController@get');
    $router->post('/', 'SubstanceController@save');
    $router->put('/{id}', 'SubstanceController@save');
    $router->delete('/{id}', 'SubstanceController@delete');
});

$router->post('/auth/login', 'AuthController@postLogin');
