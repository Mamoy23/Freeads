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
Route::get('/home', 'HomeController@index')->name('home');
Route::post('user/{user}/edit', 'UserController@edit');
Route::post('user/{user}', 'UserController@update');
Route::resource('user', 'UserController');
Auth::routes(['verify' => true]);


Route::post('ad/{ad}/edit', 'AdController@edit');
Route::post('ad/{ad}', 'AdController@update');
Route::post('ad/create', 'AdController@create');
Route::get('ad/list', 'AdController@list')->name('ad.list');
Route::get('ad/search', 'AdController@search')->name('ad.search');
Route::get('ad/recent', 'AdController@searchRecent')->name('ad.recent');
Route::resource('ad', 'AdController');

Route::get('chat/{user}', 'ChatController@show')->name('chat.show');
Route::post('chat/{user}', 'ChatController@store');
Route::resource('chat', 'ChatController');