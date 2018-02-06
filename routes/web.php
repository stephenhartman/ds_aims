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

//Admin Routes
Route::middleware(['admin'])->group(function () {
    Route::resource('events.event_sign_ups', 'EventSignUpController');
    Route::resource('posts', 'PostController', ['except' => 'index', 'show']);
    Route::resource('events', 'EventController', ['except' => 'index', 'show']);

    Route::get('/admin/home', 'HomeController@index')->name('admin/home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('events.event_sign_ups', 'EventSignUpController');
Route::resource('posts', 'PostController', ['only' => ['index', 'show']]);
Route::resource('events', 'EventController', ['only' => ['index', 'show']]);



Route::resource('users', 'UserController', ['only' => ['index', 'show']]);
Route::match(['get', 'post'], '/users-data', 'UserController@data');

Route::get('auth/{driver}', 'Auth\SocialController@redirectToProvider');
Route::get('auth/{driver}/callback', 'Auth\SocialController@handleProviderCallback');


