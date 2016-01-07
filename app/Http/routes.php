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
    Route::get('dashboard/{month}/{year}/MonthStatistic', ['as' => 'admin.dashboard.monthStatistic', 'uses' => 'DashboardController@monthStatistic']);
    Route::get('dashboard/EmployeeStatistic', ['as' => 'admin.dashboard.employeeStatistic', 'uses' => 'DashboardController@employeeStatistic']);
    Route::get('dashboard/HQStatistic', ['as' => 'admin.dashboard.hqStatistic', 'uses' => 'DashboardController@hqStatistic']);

//    Route::get('setting', ['as' => 'admin.setting.index', 'uses' => 'SettingController@getSettings']);
    // POST
//    Route::post('language/change', ['as' => 'admin.language.change' , 'uses' => 'LanguageController@postChange']);
//    Route::post('page/order', ['as' => 'admin.page.order' , 'uses' => 'PageController@postOrder']);
    // PATCH
//    Route::patch('setting/{setting}', ['as' => 'admin.setting.update', 'uses' => 'SettingController@patchSettings']);
    // Resources

//    Route::resource('language', 'LanguageController');
    Route::resource('user', 'UserController');
    Route::resource('employee', 'EmployeeController');
    Route::post('companies/search', ['as' => 'admin.companies.search', 'uses' => 'CompaniesController@search']);
    Route::get('companies/search', 'CompaniesController@search');
    Route::resource('companies', 'CompaniesController');
    Route::post('products/{id}/{type}/delete', ['as' => 'admin.products.delete', 'uses' => 'ProductsController@delete']);
    Route::resource('products', 'ProductsController');
    Route::resource('jobs', 'JobsController');
    Route::get('news/{type}/options', ['as' => 'admin.news.options', 'uses' => 'NewsController@getTagsList']);
    Route::get('news/{id}/selectedOptions', ['as' => 'admin.news.search', 'uses' => 'NewsController@getTags']);
    Route::resource('news', 'NewsController');
    Route::get('source/{id}/productFocusSubType', ['as' => 'admin.source.productFocusSubType', 'uses' => 'AjaxController@productFocusSubType']);
    Route::get('source/{id}/productFocusType', ['as' => 'admin.source.productFocusType', 'uses' => 'AjaxController@productFocusType']);
    Route::get('source/{id}/JobFamily', ['as' => 'admin.source.JobFamily', 'uses' => 'AjaxController@jobTypeByJobFamily']);
    Route::get('source/{id}/GetCoutryRegion', ['as' => 'admin.source.GetCoutryRegion', 'uses' => 'AjaxController@getCoutryByRegion']);

});