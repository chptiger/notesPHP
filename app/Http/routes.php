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
$app->post('/logout', 'AuthController@logout');
$app->get('/', function () use ($app) {
//dd("Hello World \n");
return $app->version() . ' with Docker is running...----';
//	phpinfo();
});



