<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	// if: authorized, show 'show_tasks'
	if (Auth::check()) {
		return Redirect::to('/task');
	}
	// else:
	return View::make('hello');
});

// User registration and login
Route::get(	'/user/register', 'UserController@showForm'	);
Route::post('/user/register', 'UserController@processForm');
Route::get( '/user/login', 'UserController@showLogin');
Route::post('/user/login', 'UserController@processLogin');

Route::get('/user/logout', 'UserController@processLogout');
Route::get('/user/settings', array('before' => 'auth', 'uses' => 'UserController@showSettings'));
Route::post('/user/settings', array('before' => 'auth', 'uses' => 'UserController@processSettings'));

// Task management (must be authenticated)
Route::get(	'/task'						, function() { return Redirect::to('task/list'); });
Route::get(	'/task/list/{list_id?}'		, array('before' => 'auth', 'uses' => 'TaskController@showTasks'		));
Route::get(	'/task/add/{scope?}/{list?}', array('before' => 'auth', 'uses' => 'TaskController@showForm'			));
Route::post('/task/add/{scope?}/{list?}', array('before' => 'auth', 'uses' => 'TaskController@processForm'		));
Route::get(	'/task/edit/{id}/{list?}'	, array('before' => 'auth', 'uses' => 'TaskController@editTask'			));
Route::post('/task/edit/{id}/{list?}'	, array('before' => 'auth', 'uses' => 'TaskController@processEdit'		));
Route::get(	'/task/up/{id}/{list?}'		, array('before' => 'auth', 'uses' => 'TaskController@pushUp'			));
Route::get(	'/task/down/{id}/{list?}'	, array('before' => 'auth', 'uses' => 'TaskController@pushDown'			));
Route::get(	'/task/mark/{id}/{list?}'	, array('before' => 'auth', 'uses' => 'TaskController@markComplete'		));
Route::get(	'/task/unmark/{id}/{list?}'	, array('before' => 'auth', 'uses' => 'TaskController@unmarkComplete'	));
Route::get(	'/task/remove/{id}/{list?}'	, array('before' => 'auth', 'uses' => 'TaskController@removeConfirm'	));
Route::post('/task/remove/{id}/{list?}'	, array('before' => 'auth', 'uses' => 'TaskController@processRemoval'	));

// List management (must be authenticated)
Route::get('/list', array('before' => 'auth', 'uses' => 'ListController@showLists'));
Route::get('/list/add', array('before' => 'auth', 'uses' => 'ListController@addForm'));
Route::post('/list/add', array('before' => 'auth', 'uses' => 'ListController@processAdd'));
Route::get('/list/edit/{id}', array('before' => 'auth', 'uses' => 'ListController@editForm'));
Route::post('/list/edit/{id}', array('before' => 'auth', 'uses' => 'ListController@processEdit'));
Route::get('/list/remove/{id}', array('before' => 'auth', 'uses' => 'ListController@removeForm'));
Route::post('/list/remove/{id}', array('before' => 'auth', 'uses' => 'ListController@processRemoval'));

// Debug
Route::get('/user/check', 'UserController@checkLogin');