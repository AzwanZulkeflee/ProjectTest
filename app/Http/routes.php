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
 // Authentication routes...
Route::get('/', function () {
    return redirect()->route('app.dashboard');
});

Route::get('/auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

// password controller
Route::controllers([
    '/password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'app',
    'middleware' => ['auth','auth.ifrole'],
    'auth.ifrole' => ['admin','user']], function() {

    Route::get('/', ['as' => 'app.dashboard', function () {
        return view('dashboard.index');
    }]);

    Route::get('dashboard', 'DashboardController@getIndex');

    Route::get('staff', 'DashboardController@getDirectory');

    Route::controller('leave', 'LeaveController');

    Route::controller('request', 'Employee\AppReqController');

    Route::controller('profile', 'Employee\ProfileController');
    
    Route::controller('file', 'FileController');

});

Route::group(['prefix' => 'admin',
    'middleware' => ['auth','auth.ifrole'],
    'auth.ifrole' => ['admin']], function() {

    Route::controller('employee', 'Admin\EmployeeController');
    Route::controller('user', 'Admin\UserController');
    Route::controller('setting', 'Admin\SettingController');

    Route::get('/auth/register', ['as'=>'register','uses'=> 'Auth\AuthController@getRegister']);
    Route::post('/auth/register', 'Auth\AuthController@postRegister');
});