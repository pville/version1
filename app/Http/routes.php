<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('dashboard', ['middleware' => 'auth', 'uses' => 'DashboardController@index']);
Route::get('dashboard/screening', ['middleware' => 'auth', 'uses' => 'DashboardController@getScreening']);

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');


Route::get('logout', 'Auth\AuthController@getLogout');
Route::post('logout', 'Auth\AuthController@postLogout');



Route::get('/events/create', 'EventController@getCreateEvent');
Route::post('/events/create', 'EventController@postCreateEvent');


Route::controllers([
	'register' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['prefix' => 'api/v1'], function() {

    route::resource('group','API\GroupController');
});

Route::get('{OrganizationSlug}/events/{EventSlug}', ['uses' => 'EventController@getEvent']);
Route::post('{OrganizationSlug}/events/{EventSlug}/join', ['uses' => 'EventController@postJoinEvent']);

Route::get('profile/{OrganizationSlug}}', ['uses' => 'EventController@getEvent']);

Route::post('dashboard/adduser', ['uses' => 'OrganizationController@postInviteUser']);

Route::get('invite/{InviteCode}', ['uses' => 'InviteController@getInvite']);

Route::get('screening/{id}', ['uses' => 'ScreeningController@getScreenForm']);

Route::post('/screening/verify/{id}', function($id,  Illuminate\Http\Request $request) {
    $app = app();
    $controller = $app->make('App\Http\Controllers\ScreeningController');
    return $controller->callAction('postVerifyUser', $parameters = array($id, $request));
});



Route::get('/events/screen/{id}', ['uses' => 'ScreeningController@getScreenFormForOrg']);
Route::post('/events/screen/{id}', function($id,  Illuminate\Http\Request $request) {
    $app = app();
    $controller = $app->make('App\Http\Controllers\ScreeningController');
    return $controller->callAction('postScreenData', $parameters = array($id, $request));
});
Route::get('/screening/data/{id}',  ['uses' => 'ScreeningController@getFormData']);
