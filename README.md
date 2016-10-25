# notesPHP

1. build lumen project notesDemoPHP
	composer create-project laravel/lumen=5.2.* usernotes --prefer-dist
	
2. Integrate with JWT token and barryvdh/laravel-cors 
	JWT token used for HTTP Authentication
	barryvdh/laravel-cors used for fixed CORS problerms.
	
3. test phpunit & postman
	export PATH=./vendor/bin:$PATH
	phpunit
	
	use postman to test the whole application.

4. build table users and notes: 
	php artisan make:migration create_users_table --create=users
	php artisan make:migration create_notes_table --create=notes
	php artisan make:migration associate_notes_with_users --table=notes
	use associate table define one to many relationship.
	
5. declare columns for table users and notes and define one to many relationship
	php artisan migrate:refresh
	php artisan db:seed

6. declare routes for both user and note
   declare jwt middleware for every request, except login request.
   ex:
   
    $app->post('/login', 'AuthController@login');
	
	$app->get('/', function () use ($app) {
		return $app->version() . ' with Docker is running...----';
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
	
7. build class and controller for user and note
    build the RESTful API to allow CRUD operations on both notes and users in controllers.
	add fields validation for notes and users in create and update method in controllers
	
8. support JSON for request and response, notes access is restricted to the user.
   Use lumen ORM to build table and CRUD operation.
   
9. useful and thanks for github links:
	https://github.com/barryvdh/laravel-cors
	https://github.com/tymondesigns/jwt-auth