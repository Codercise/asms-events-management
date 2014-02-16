<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/
//Register controllers in routes
Route::controller(array('users'));
Route::controller(array('sessions'));
Route::controller(array('pdevents'));
Route::controller(array('admin_users'));

Route::get('/', function()
{
  if (Auth::check()) {
    return Redirect::to('user/dashboard');
  } else {
	  return View::make('home.index');
  }
});

/**** Static Pages Routes ****/
Route::get('help', function() {
  return View::make('static_pages.help');
});

Route::get('contact', function() {
  return View::make('static_pages.contact');
});

/**** User Routes ****/
Route::get('sign_up', function() {
  if (Auth::check()) {
    return Redirect::to('user/dashboard');
  } else {
    return View::make('users.create');
  }
});

Route::post('sign_up', array('as' => 'sign_up', 'do' => function() {}));
Route::get('user/dashboard', array('before' => 'auth', 'uses' => 'users@dashboard'));
Route::get('user/dashboard/settings', array('before' => 'auth', 'uses' => 'users@edit'));
Route::get('user/forgotten', function(){
  return View::make('users.forgotten');
});
Route::post('user/forgotten', array('uses' => 'users@forgotten'));
Route::post('user/attend_modal', array('uses' => 'users@attend_modal'));
/**** Session Routes ****/
//get login page
Route::get('login', function() {
  return Redirect::to('sign_in');
});
//this route redirects users to their dashboard if they're already signed in
Route::get('sign_in', function() {
  if (Auth::check()) {
    return Redirect::to('user/dashboard');
  } else {
    return View::make('sessions.create');
  }
});
//sign out route
Route::get('sign_out', function() {
  Auth::logout();
  Session::flush();
  return Redirect::to('/')->with('status', "You signed out");
});
//posting sign in form
Route::post('sign_in', array('as' => 'sign_in', 'do' => function(){
}));

/**** Events Routes ****/
Route::get('/event/create', array('before' => 'auth', 'uses' => 'pdevents@create'));
Route::post('/event/create', array('before' => 'auth', 'uses' => 'pdevents@create'));
//all events
Route::get('/events/all', array('uses' => 'pdevents@all'));
//individual event
Route::get('/event/(:num)', array('before' => 'auth', 'uses' => 'pdevents@show'));
Route::post('/event/(:num)', array('uses' => 'pdevents@show'));
//upcoming events
Route::get('/events/upcoming', array('uses' => 'pdevents@upcoming'));
//past events
Route::get('/events/past_events', array('uses' => 'pdevents@past_events'));
Route::get('/events/past', array('uses' => 'pdevents@past_events'));
//my events
Route::get('/events/myevents', array('uses' => 'pdevents@my_events'));
Route::get('/events/my_events', array('uses' => 'pdevents@my_events'));
//attend event
Route::get('/event/(:num)/attend', array('uses' => 'pdevents@attend'));
//unattend event
Route::get('/event/(:num)/unattend', array('uses' => 'pdevents@unattend'));
//put user on notify list
Route::get('/event/(:num)/notify', array('uses' => 'pdevents@notify'));
/**** Admin Routes ****/
Route::get('/event/(:num)/delete', array('before' => 'auth', 'uses' => 'pdevents@delete'));
Route::get('/admin/dashboard', array('uses' => 'admin_users@dashboard'));
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
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
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