<?php

require_once __DIR__ . '/../vendor/autoload.php';

//enable .env file
try {
	(new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
	//
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
	realpath(__DIR__ . '/../')
);

// enable Facades and Eloquent
$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
	Illuminate\Contracts\Debug\ExceptionHandler::class,
	App\Exceptions\Handler::class
);

$app->singleton(
	Illuminate\Contracts\Console\Kernel::class,
	App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//    App\Http\Middleware\ExampleMiddleware::class
// ]);

//        $app->routeMiddleware([
//            'auth' => App\Http\Middleware\Authenticate::class,
//            'token' =>App\Http\Middleware\TokenMiddleware::class,
//            'jwt'=>App\Http\Middleware\JwtMiddleware::class,
//        ]);


// retgister route middleware HelloMiddleware.php for testing
//$app->middleware([
//    Barryvdh\Cors\HandleCors::class,
//]);
$app->routeMiddleware([
    'jwt' => App\Http\Middleware\JwtMiddleware::class
]);
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);
$app->register(\Barryvdh\Cors\LumenServiceProvider::class);

$app->register(\App\Providers\FractalServiceProvider::class);

if (!class_exists('JWTAuth')) {
    class_alias('Tymon\JWTAuth\Facades\JWTAuth', 'JWTAuth');
}
//class_alias(Tymon\JWTAuth\Facades\JWTAuth::class, 'JWTAuth');
if (!class_exists('JWTFactory')) {
    class_alias('Tymon\JWTAuth\Facades\JWTFactory', 'JWTFactory');
}

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/


$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
	require __DIR__ . '/../app/Http/routes.php';
});
//$app->configure('app');
//$app->configure('database');
//$app->configure('cache');
//$app->configure('cors');

return $app;