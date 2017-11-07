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

Route::get(
    '/', function () {
        return view('welcome');
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController');

Route::resource('users', 'UserController', ['only' => ['index', 'show']]);
Route::match(['get', 'post'], '/users-data', 'UserController@data');

Route::resource('events', 'EventController');

Route::get('auth/{driver}', 'Auth\SocialController@redirectToProvider');
Route::get('auth/{driver}/callback', 'Auth\SocialController@handleProviderCallback');

