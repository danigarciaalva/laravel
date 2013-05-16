<?php

Route::get('/', function()
{
	$data= array(
			'nombre' => 'Daniel',
			'apellido' => 'Garcia'
	);
	return View::make('home.index', array(
			'items' => array('Item 1', 'Item2', 'Item3'
		)));
});

Route::get('about', function()
{
	return View::make('home.about');
});

Route::get('DB',function()
{
	$title = 'Second post in laravel';
	$body = 'Another nice post :D';

	$posts = DB::query('INSERT INTO posts VALUES (null, :title, :body)',
		array($title, $body));
	//$posts = DB::query('SELECT * FROM posts');
});

Route::get('DBetter', function()
{
	/*
	$query = DB::table('posts')->where('id','=',1)->first(); SELECT * FROM posts WHERE id = 1 LIMIT 1
	dd($query);
	$query2 = DB::table('posts')->first(); // SELECT * FROM posts LIMIT 1
	dd($query2);
	$query3 = DB::table('posts')->where_id(2)->get(); // Dinamyc function
	dd($query3);
	$query4 = DB::table('posts')
		->where(function($query){
			$query->where('id','=',2);
		})->get();
	dd($query4);
	*/
	$query5 = DB::table('posts')->order_by('id','desc')->get();
	dd($query5);
});
/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});
