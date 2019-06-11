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


$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->post(
        'auth/login', 
        [
           'uses' => 'AuthController@authenticate'
        ]
    );

    $router->group(['prefix' => 'user-flow', 'middleware' => 'jwt.auth'], function () use ($router) {

        $router->get('/flow/count/weekly', 'UserFlowController@flowCountWeekly');
    });
});

// Demo Users to login
$router->get('/users/list', 'UserController@list');