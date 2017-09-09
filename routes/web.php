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


/* Restaurants routes */
Route::get('/', [
    'as' => 'welcome',
    'uses' => 'RestaurantsController@welcome'
]);

Route::get('restaurants/', [

    'as' => 'restaurants',
    'uses' => 'RestaurantsController@index'

]);


Route::post('restaurants/store', [
    'as' => 'restaurants.store',
    'uses' => 'RestaurantsController@store'
    ]);

Route::get('restaurants/add', 'RestaurantsController@create')->middleware('auth:admin');

Route::get('restaurants/{restaurant}', [

    'as' => 'restaurants.show',
    'uses' => 'RestaurantsController@show'

]);
Route::post('restaurants/sort', [

    'as' => 'restaurants.sort',
    'uses' => 'RestaurantsController@sort'

]);

Route::post('restaurants/sortById', [

    'as' => 'restaurants.sortById',
    'uses' => 'RestaurantsController@sortById'

]);

Route::post('restaurants/search', [
    'as' => 'restaurants.search',
    'uses' => 'RestaurantsController@search'
]);

Route::get('restaurants/autocompleteSearch/', [

    'as' => 'restaurants.autocompleteSearch',
    'uses' => 'RestaurantsController@autocompleteSearch'

]);

/* admin routes*/
Route::group(['prefix' => 'admin'],function(){

    Route::get('login', [
    'as' => 'admin.login',
    'uses' => 'Auth\AdminLoginController@showLoginForm'
    ]);

    Route::post('login', [
    'as' => 'admin.login.submit',
    'uses' => 'Auth\AdminLoginController@login'
    ]);

    Route::get('/', [
        'as' => 'admin.dashboard',
        'uses' =>'Admin\AdminController@index'
    ]);

});



Auth::routes();


/* User routes */
Route::get('/home', 'HomeController@index');


//requirement routes
Route::resource('requirements', 'RequirementController', ['except' => ['create']]);