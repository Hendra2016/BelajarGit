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


Route::get('/', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('task/show/{id}',['as' => 'task.show', 'uses' => 'TaskController@show']);

Route::get('/task','TaskController@index');
Route::post('/task', 'TaskController@store');
Route::get('/task/edit/{task}', 'TaskController@edit');
Route::get('/task/add', 'TaskController@add');
Route::delete('/task/{task}', ['as'=>'task.delete','uses'=>'TaskController@delete']);

/*Route::get('/', ['middleware' => 'auth', function (){
	if(Auth::check()){
		return redirect('/task');
	}
}]);*/