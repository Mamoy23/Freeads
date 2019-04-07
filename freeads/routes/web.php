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

Route::get('/', 'IndexController@showIndex')->middleware('count');
Route::get('/home', 'HomeController@index')->name('home')->middleware('count');
Route::post('user/{user}/edit', 'UserController@edit')->middleware('count');
Route::post('user/{user}', 'UserController@update')->middleware('count');
Route::resource('user', 'UserController')->middleware('count');
Auth::routes(['verify' => true]);


Route::get('ad/match', 'AdController@matching')->name('ad.match')->middleware('count');
Route::post('ad/match', 'AdController@matching')->middleware('count');
Route::post('ad/{ad}/edit', 'AdController@edit')->middleware('count');
Route::post('ad/{ad}', 'AdController@update')->middleware('count');
Route::post('ad/create', 'AdController@create')->middleware('count');
Route::get('ad/list', 'AdController@list')->name('ad.list')->middleware('count');
Route::get('ad/search', 'AdController@search')->name('ad.search')->middleware('count');
Route::get('ad/recent', 'AdController@searchRecent')->name('ad.recent')->middleware('count');
Route::resource('ad', 'AdController')->middleware('count');

Route::get('chat/{user}', 'ChatController@show')->name('chat.show')->middleware('count');
Route::post('chat/{user}', 'ChatController@store')->middleware('count');
Route::resource('chat', 'ChatController')->middleware('count');