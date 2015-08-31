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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [
    'as' => 'root', 'uses' => 'WelcomeController@index'
]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('admin/index', [
    'as' => 'root', 'uses' => 'Admin\MainController@index'
]);
Route::resource('profile', 'ProfileController');

// Admin routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
    // GET
    Route::get('/', ['as' => 'admin.root', 'uses' => 'DashboardController@index']);
    Route::get('setting', ['as' => 'admin.setting.index', 'uses' => 'SettingController@getSettings']);
    // POST
    Route::post('language/change', ['as' => 'admin.language.change' , 'uses' => 'LanguageController@postChange']);
    Route::post('page/order', ['as' => 'admin.page.order' , 'uses' => 'PageController@postOrder']);
    // PATCH
    Route::patch('setting/{setting}', ['as' => 'admin.setting.update', 'uses' => 'SettingController@patchSettings']);
    // Resources

    Route::resource('language', 'LanguageController');
    Route::resource('page', 'PageController');
    Route::resource('user', 'UserController');
    Route::resource('employee', 'EmployeeController');
});