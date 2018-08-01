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
Route::get('/', 'HomeController@getIndex')->name('home');

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

Route::get('/user/', 'StatusController@getIndex')->name('user.index');

Route::get('/client/', 'StatusController@getIndex')->name('client.index');

Route::get('/project/', 'ProjectController@getIndex')->name('project.index');
Route::get('/project/create', 'ProjectController@getCreate')->name('project.create');
Route::post('/project/store', 'ProjectController@postStore')->name('project.store');
Route::get('/project/edit/{id}', 'ProjectController@getEdit')->name('project.edit');
Route::post('/project/update', 'ProjectController@postUpdate')->name('project.update');
Route::post('/project/destroy', 'ProjectController@postDestroy')->name('project.destroy');

Route::get('/timeslot/', 'StatusController@getIndex')->name('timeslot.index');

Route::get('/type/', 'StatusController@getIndex')->name('type.index');


Auth::routes();
