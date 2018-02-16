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
    Route::resource('posts', 'PostController', ['except' => 'index', 'show']);
    Route::resource('events', 'EventController', ['except' => 'index', 'show']);
    Route::get('/admin/home', 'HomeController@index')->name('admin/home');
    //DataTables
    Route::get('alumni', 'UserController@index')->name('alumni');
    Route::match(['get', 'post'], '/alumni-data', 'UserController@alumni_data');
    Route::get('alumni/education', 'UserController@education')->name('alumni/education');
    Route::match(['get', 'post'], '/education-data', 'UserController@education_data');
    Route::get('alumni/occupation', 'UserController@occupation')->name('alumni/occupation');
    Route::match(['get', 'post'], '/occupation-data', 'UserController@occupation_data');
});

// Verified Email routes
Route::group(['middleware' => ['isVerified']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('posts', 'PostController', ['only' => ['index', 'show']]);
    Route::resource('events', 'EventController', ['only' => ['index', 'show']]);
    Route::resource('users', 'UserController', ['only' => 'show']);

    // Nested routes for alumni
    Route::get('users/{user}/alumni/{alumnus}/community', 'AlumnusController@community')->name('community');
    Route::post('users/{user}/alumni/{alumnus}/final_store', 'AlumnusController@final_store')->name('final_store');
    Route::resource('users.alumni', 'AlumnusController', ['except' => ['index', 'destroy']]);
    Route::resource('users.alumni.milestones', 'MilestoneController', ['only' => 'index']);
    Route::resource('users.alumni.education', 'EducationController', ['except' => ['index']]);
    Route::resource('users.alumni.occupation', 'OccupationController', ['except' => ['index']]);
});

// Oauth
Route::get('auth/{driver}', 'Auth\SocialController@redirectToProvider');
Route::get('auth/{driver}/callback', 'Auth\SocialController@handleProviderCallback');

// Email verification
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
Route::get('resend-verification/{id}', 'Auth\RegisterController@resendVerification')->name('resend-verification');
