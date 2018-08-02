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

//Home Page
Route::get('/', 'HomeController@index')->name('home');

Route::get('/status/', 'StatusController@getIndex')->name('status.index');
Route::get('/status/create', 'StatusController@getCreate')->name('status.create');
Route::post('/status/store', 'StatusController@postStore')->name('status.store');
Route::get('/status/edit/{id}', 'StatusController@getEdit')->name('status.edit');
Route::post('/status/update', 'StatusController@postUpdate')->name('status.update');
Route::post('/status/destroy', 'StatusController@postDestroy')->name('status.destroy');

Route::get('/priority/', 'PriorityController@getIndex')->name('priority.index');
Route::get('/priority/create', 'PriorityController@getCreate')->name('priority.create');
Route::post('/priority/store', 'PriorityController@postStore')->name('priority.store');
Route::get('/priority/edit/{id}', 'PriorityController@getEdit')->name('priority.edit');
Route::post('/priority/update', 'PriorityController@postUpdate')->name('priority.update');
Route::post('/priority/destroy', 'PriorityController@postDestroy')->name('priority.destroy');

Route::get('/user/', 'UserController@getIndex')->name('user.index');
Route::get('/user/create', 'UserController@getCreate')->name('user.create');
Route::post('/user/store', 'UserController@postStore')->name('user.store');
Route::get('/user/edit/{id}', 'UserController@getEdit')->name('user.edit');
Route::post('/user/update', 'UserController@postUpdate')->name('user.update');
Route::post('/user/destroy', 'UserController@postDestroy')->name('user.destroy');

Route::get('/client/', 'StatusController@getIndex')->name('client.index');

Route::get('/project/', 'ProjectController@getIndex')->name('project.index');
Route::get('/project/create', 'ProjectController@getCreate')->name('project.create');
Route::post('/project/store', 'ProjectController@postStore')->name('project.store');
Route::get('/project/edit/{id}', 'ProjectController@getEdit')->name('project.edit');
Route::post('/project/update', 'ProjectController@postUpdate')->name('project.update');
Route::post('/project/destroy', 'ProjectController@postDestroy')->name('project.destroy');

Route::get('/timeslot/', 'TimeslotController@getIndex')->name('timeslot.index'); 
Route::get('/timeslot/create', 'TimeslotController@getCreate')->name('timeslot.create'); 
Route::post('/timeslot/store', 'TimeslotController@postStore')->name('timeslot.store'); 
Route::get('/timeslot/edit/{id}', 'TimeslotController@getEdit')->name('timeslot.edit'); 
Route::post('/timeslot/update', 'TimeslotController@postUpdate')->name('timeslot.update'); 
Route::post('/timeslot/destroy', 'TimeslotController@postDestroy')->name('timeslot.destroy');

Route::get('/client/', 'ClientController@getIndex')->name('client.index');
Route::get('/client/create', 'ClientController@getCreate')->name('client.create');
Route::post('/client/store', 'ClientController@postStore')->name('client.store');
Route::get('/client/edit/{id}', 'ClientController@getEdit')->name('client.edit');
Route::post('/client/update', 'ClientController@postUpdate')->name('client.update');
Route::post('/client/destroy', 'ClientController@postDestroy')->name('client.destroy');

Route::get('/type/', 'StatusController@getIndex')->name('type.index');


Auth::routes();
