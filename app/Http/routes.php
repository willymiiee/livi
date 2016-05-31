<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return redirect('home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['api']], function () {
	Route::group(['prefix' => '/api'], function () {
		Route::group(['prefix' => 'category'], function () {
			Route::get('/list/{skip?}', 'Book\CategoryController@all');
			Route::post('/find/{skip?}', 'Book\CategoryController@find');
		});
		Route::group(['prefix' => 'books'], function () {
			Route::get('/', 'Book\BookController@getBook');
			Route::post('/detail', 'Book\BookController@find');
		});
		Route::post('order', 'Order\OrderController@store');
	});
});

Route::group(['middleware' => ['web']], function () {
});

Route::group(['middleware' => 'web'], function () {
	Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
	Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
	Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

	// Registration Routes...
	Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
	Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@register']);

	// Password Reset Routes...
	Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
	Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
	Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);	

	Route::get('/home', 'HomeController@index');

	Route::group(['prefix' => '/books', 'middleware' => ['auth']], function () {
		Route::group(['prefix' => 'list'], function () {
			Route::get('/', 'Book\BookController@index');
			Route::get('/add', 'Book\BookController@create');
			Route::post('/add', 'Book\BookController@store');
			Route::get('/edit/{id}', 'Book\BookController@edit');
			Route::put('/edit', 'Book\BookController@update');
			Route::get('/delete/{id}', 'Book\BookController@destroy');
			// Route::get('/get/{id}', ['as' => 'getcategory', 'uses' => 'Book\CategoryController@getCategory']);
		});

		Route::group(['prefix' => 'categories'], function () {
			Route::get('/', 'Book\CategoryController@index');
			Route::get('/add', 'Book\CategoryController@create');
			Route::post('/add', 'Book\CategoryController@store');
			Route::get('/edit/{id}', 'Book\CategoryController@edit');
			Route::post('/edit', 'Book\CategoryController@update');
			Route::get('/delete/{id}', 'Book\CategoryController@destroy');
			Route::get('/get/{id}', ['as' => 'getcategory', 'uses' => 'Book\CategoryController@getCategory']);
		});
	});

	Route::group(['prefix' => '/settings', 'middleware' => ['auth']], function () {
		Route::group(['prefix' => 'menu'], function () {
			Route::get('/', 'Setting\MenuController@index');
			Route::get('/add', 'Setting\MenuController@create');
			Route::post('/add', 'Setting\MenuController@store');
			Route::get('/edit/{id}', 'Setting\MenuController@edit');
			Route::post('/edit', 'Setting\MenuController@update');
			Route::get('/delete/{id}', 'Setting\MenuController@destroy');
			Route::get('/get/{id}', ['as' => 'getmenu', 'uses' => 'Controller@getMenu']);
		});

		Route::group(['prefix' => 'role'], function () {
			Route::get('/', 'Setting\RoleController@index');
			Route::get('/add', 'Setting\RoleController@create');
			Route::post('/add', 'Setting\RoleController@store');
			Route::get('/edit/{id}', 'Setting\RoleController@edit');
			Route::post('/edit', 'Setting\RoleController@update');
			Route::get('/delete/{id}', 'Setting\RoleController@destroy');
		});

		Route::group(['prefix' => 'access'], function () {
			Route::get('/{id}', 'Setting\AccessController@edit');
			Route::post('/edit', 'Setting\AccessController@update');
		});
	});
});
