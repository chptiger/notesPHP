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
$app->post('/login', 'AuthController@login');
$app->get('/', function () use ($app) {
//dd("Hello World \n");
return $app->version() . ' with Docker is running...----';
//	phpinfo();
});
$app->group(['middleware' =>'jwt', 'namespace' =>'App\Http\Controllers'], function() use($app){
    $app->get('/notes', 'NotesController@index');
    $app->get('/notes/{id:[\d]+}', 'NotesController@show');
    $app->delete('/notes/{id:[\d]+}', 'NotesController@destroy');
    $app->post('/notes', 'NotesController@store');
    $app->put('/notes/{id:[\d]+}', 'NotesController@update');

    $app->get('/users', 'UsersController@index');
    $app->get('/users/{id:[\d]+}', 'UsersController@show');
    $app->delete('/users/{id:[\d]+}', 'UsersController@destroy');
    $app->post('/users', 'UsersController@store');
    $app->put('/users/{id:[\d]+}', 'UsersController@update');

    $app->post('/logout', 'AuthController@logout');
});


