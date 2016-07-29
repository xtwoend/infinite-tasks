<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', function(){
	return redirect()->to('login');
});

Route::get('/dashboard', 'HomeController@index');

// Tasks
Route::get('tasks/{id}/quick', ['as' => 'tasks.quick', 'uses' => 'TaskController@quick']);
Route::post('tasks/data', ['as' => 'tasks.data', 'uses' => 'TaskController@lists']);
Route::resource('tasks', 'TaskController');

// users
Route::get('user/{id}/quick', ['as' => 'user.quick', 'uses' => 'UserController@quick']);
Route::post('user/data', ['as' => 'user.data', 'uses' => 'UserController@lists']);
Route::resource('user', 'UserController');