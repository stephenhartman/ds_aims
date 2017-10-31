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

Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleProviderCallback');

Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookProviderCallback');
