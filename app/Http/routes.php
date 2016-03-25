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

Route::group(['middleware' => ['web']], function () {
	//
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

	Route::group(['prefix' => '/settings', 'middleware' => ['auth']], function () {
		Route::group(['prefix' => 'menu'], function () {
			Route::get('/', 'Setting\MenuController@menu_list');
			Route::get('/add', 'Setting\MenuController@menu_add');
			Route::post('/add', 'Setting\MenuController@menu_insert');
			Route::get('/edit/{id}', 'Setting\MenuController@menu_edit');
			Route::post('/edit', 'Setting\MenuController@menu_update');
			Route::get('/delete/{id}', 'Setting\MenuController@menu_delete');
			Route::get('/get/{id}', ['as' => 'getmenu', 'uses' => 'Setting\MenuController@get_menu']);
		});

		Route::group(['prefix' => 'role'], function () {
			Route::get('/', 'Setting\RoleController@role_list');
			Route::get('/add', 'Setting\RoleController@role_add');
			Route::post('/add', 'Setting\RoleController@role_insert');
			Route::get('/edit/{id}', 'Setting\RoleController@role_edit');
			Route::post('/edit', 'Setting\RoleController@role_update');
			Route::get('/delete/{id}', 'Setting\RoleController@role_delete');
		});

		Route::group(['prefix' => 'access'], function () {
			Route::get('/', 'Setting\AccessController@role_list');
			Route::get('/add', 'Setting\AccessController@role_add');
			Route::post('/add', 'Setting\AccessController@role_insert');
			Route::get('/edit/{id}', 'Setting\AccessController@role_edit');
			Route::post('/edit', 'Setting\AccessController@role_update');
			Route::get('/delete/{id}', 'Setting\AccessController@role_delete');
		});
	});
});
