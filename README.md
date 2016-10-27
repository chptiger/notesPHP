# notesPHP

The project(notesDemoPHP) uses Lumen and MySql to build a RESTful API. Lumen is a mircro-framework to provide RESTful API and full Eloquent ORM to manage tables in database.

The design process is from database to classes and from classes to controller.

From the document of new-hire-coding-chanllenge-php.docx, one user can have many notes and note access should be restricted the owner of the note.

For that case, I have my database design method. I design two tables in the database, user and note. The table note has one foreign key uid to reference table user. The relationship bewteen note and user is many-to-one. 

From the database design, There are two classes in this project, Note.php and User.php in notesDemoPHP. many-to-one relationship is declared in the Note.php.
notesDemoPHP provides CRUD operation for both user and notes.

Following is the process:

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
	
10. Demonstration:
   GET 		http://localhost:8090/notesDemoPHP/public/notes
   GET 		http://localhost:8090/notesDemoPHP/public/notes/{id}
   DELETE 	http://localhost:8090/notesDemoPHP/public/notes/{id}
   PUT 		http://localhost:8090/notesDemoPHP/public/notes/{id}
   POST 	http://localhost:8090/notesDemoPHP/public/notes
   
   GET 		http://localhost:8090/notesDemoPHP/public/users
   GET 		http://localhost:8090/notesDemoPHP/public/users/{id}
   DELETE 	http://localhost:8090/notesDemoPHP/public/users/{id}
   PUT 		http://localhost:8090/notesDemoPHP/public/users/{id}
   POST 	http://localhost:8090/notesDemoPHP/public/users
