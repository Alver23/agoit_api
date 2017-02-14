<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alain', function () {
    return "This is a test...";
});

//  Priorities Routes
Route::get('/priority', 'PriorityController@index')->middleware('auth.basic.once');
Route::post('/priority/storing', 'PriorityController@store')->middleware('auth.basic.once');
Route::get('/priority/showing/{id}', 'PriorityController@show')->middleware('auth.basic.once');
Route::put('/priority/updating/{id}', 'PriorityController@update')->middleware('auth.basic.once');
Route::delete('/priority/deleting/{id}', 'PriorityController@delete')->middleware('auth.basic.once');

//  User Routes
Route::get('/user', 'UserController@index')->middleware('auth.basic.once');
Route::post('/user/storing', 'UserController@store')->middleware('auth.basic.once');
Route::get('/user/showing/{id}', 'UserController@show')->middleware('auth.basic.once');
Route::put('/user/updating/{id}', 'UserController@update')->middleware('auth.basic.once');
Route::delete('/user/deleting/{id}', 'UserController@delete')->middleware('auth.basic.once');

//  Task Routes
Route::get('/task', 'TaskController@index')->middleware('auth.basic.once');
Route::post('/task/storing', 'TaskController@store')->middleware('auth.basic.once');
Route::get('/task/showing/{id}', 'TaskController@show')->middleware('auth.basic.once');
Route::put('/task/updating/{id}', 'TaskController@update')->middleware('auth.basic.once');
Route::delete('/task/deleting/{id}', 'TaskController@delete')->middleware('auth.basic.once');
Route::post('/task/assing_task', 'TaskController@assing_task_to_user')->middleware('auth.basic.once');


Auth::routes();
Route::get('/home', 'HomeController@index');
