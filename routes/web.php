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
		$photos = \App\Photo::latest('created_at')->paginate(5);
		return view('welcome')->withPhotos($photos);
    }
);

Auth::routes();

Route::get('resend-verification/{id}', 'HomeController@resendVerification')->name('resend-verification');

//Admin Routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/home', 'HomeController@index')->name('admin/home');
    Route::resource('posts', 'PostController', ['except' => ['index', 'show']]);
    Route::resource('photos', 'PhotoController', ['except' => 'index']);

    Route::resource('events', 'EventController', ['except' => ['index', 'show']]);
    Route::resource('events.event_sign_ups', 'EventSignUpController');
    Route::resource('events.event_child', 'EventChildController');
    Route::resource('events.event_child.sign_ups', 'EventSignUpChildController');
    Route::get('/admin/home', 'HomeController@index')->name('admin/home');
    Route::resource('/admin/roles', 'RoleController', ['only' => 'index']);
    Route::post('/admin/roles/change', 'RoleController@updateRole');
    //DataTables
    Route::get('/admin/alumni', 'UserController@index')->name('alumni');
    Route::match(['get', 'post'], '/alumni-data', 'UserController@alumni_data');
    Route::get('/admin/alumni/education', 'UserController@education')->name('alumni/education');
    Route::match(['get', 'post'], '/education-data', 'UserController@education_data');
    Route::get('/admin/alumni/occupation', 'UserController@occupation')->name('alumni/occupation');
    Route::match(['get', 'post'], '/occupation-data', 'UserController@occupation_data');
    Route::get('roles', 'RoleController@index')->name('roles');
    Route::match(['get', 'post'], '/role-data', 'RoleController@role_data');
    Route::match(['get', 'post'], '/events/{event}/event_sign_ups_data', 'EventSignUpController@event_sign_ups_data');
    Route::match(['get', 'post'],  '/events/{event}/event_child/{event_child}/event_sign_ups_child_data/', 'EventSignUpChildController@event_sign_ups_child_data');
});

// Verified Email routes
Route::group(['middleware' => ['isVerified']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController', ['only' => ['index', 'show']]);
    Route::resource('events', 'EventController', ['only' => ['index', 'show']]);
    Route::resource('photos', 'PhotoController', ['only' => 'index']);
    Route::resource('events.event_sign_ups', 'EventSignUpController');
    Route::resource('events.event_child', 'EventChildController');
    Route::resource('events.event_child.sign_ups', 'EventSignUpChildController');
    Route::resource('users', 'UserController', ['only' => ['show', 'update']]);
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

//Route::get('/mailable_volunteer', function () {
//    $event = \App\Event::find(2);
//    $event_signup = \App\EventSignUp::find(1);
//
//    return new \App\Mail\EventSignupMail($event, $event_signup);
//});
//Route::get('/mailable_volunteer_child', function () {
//    $event = \App\Event::find(5);
//    $event_child = \App\EventChild::find(2);
//    $event_signup_child = \App\EventSignUpChild::find(1);
//
//    return new \App\Mail\EventSignupMail($event, null, $event_child, $event_signup_child);
//});
//Route::get('/mailable_reunion', function () {
//    $event = \App\Event::find(3);
//    $event_signup = \App\EventSignUp::find(2);
//
//    return new \App\Mail\EventSignupMail($event, $event_signup);
//});
//Route::get('/mailable_reunion_child', function () {
//    $event = \App\Event::find(6);
//    $event_child = \App\EventChild::find(6);
//    $event_signup_child = \App\EventSignUpChild::find(2);
//
//    return new \App\Mail\EventSignupMail($event, null, $event_child, $event_signup_child);
//});
//Route::get('/mailable_community', function () {
//    $event = \App\Event::find(4);
//    $event_signup = \App\EventSignUp::find(3);
//
//    return new \App\Mail\EventSignupMail($event, $event_signup);
//});
//Route::get('/mailable_community_child', function () {
//    $event = \App\Event::find(7);
//    $event_child = \App\EventChild::find(10);
//    $event_signup_child = \App\EventSignUpChild::find(3);
//
//    return new \App\Mail\EventSignupMail($event, null, $event_child, $event_signup_child);
//});
//Route::get('/mailable_user', function () {
//    $user = \App\User::find(2);
//    $year = 2;
//
//    return new \App\Mail\UpdateUser($user, $year);
//});
