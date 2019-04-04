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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'IndexController@showIndex');
Route::resource('user', 'UserController');
// Route::get('users', 'UserController@create');
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/home', 'HomeController@index')->name('home');
Route::post('user/{user}/edit', 'UserController@edit');
Route::post('user/{user}', 'UserController@update');
//Route::get('user/{user}/delete', 'UserController@destroy');

Route::get('ad/list', 'AdController@list')->name('ad.list');
Route::post('ad/{ad}/edit', 'AdController@edit');
Route::post('ad/{ad}', 'AdController@update');
Route::post('ad/create', 'AdController@create');
Route::post('ad/search', 'AdController@search')->name('ad.search');
Route::resource('ad', 'AdController');