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

Route::get('restaurants', [

    'as' => 'restaurants',
    'uses' => 'RestaurantsController@index'

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

Route::post('restaurants/rate', [
    'as' => 'restaurants.rate',
    'uses' => 'RestaurantsController@rate'
]);

/*
 * Keep this route top of any route with ::get restaurants/{anything}/
 * Otherwise 'restaurants/autocompleteSearch/ will never be reached
 */
Route::get('restaurants/autocompleteSearch/', [

    'as' => 'restaurants.autocompleteSearch',
    'uses' => 'RestaurantsController@autocompleteSearch'

]);

/*
 * Keep this route bottom of any route with ::get restaurants/{anything}/
 * Otherwise route will never be reached
 */
Route::get('restaurants/{restaurant}', [

    'as' => 'restaurants.show',
    'uses' => 'RestaurantsController@show'

]);

Route::get('restaurants/{restaurant}/subscribe', [
    'as' => 'restaurants.subscribe',
    'uses' => 'RestaurantsController@subscribe'
])->middleware('auth');

Route::get('restaurants/{restaurant}/unsubscribe', [
    'as' => 'restaurants.unsubscribe',
    'uses' => 'RestaurantsController@unsubscribe'
])->middleware('auth');

/* Campaign Routes */
Route::resource('campaigns', 'CampaignController', ['only' => [
    'index', 'show'
]]);

Route::group(['prefix' => 'partner'], function (){

    Route::get('login', [
    'as' => 'partner.login',
    'uses' => 'Auth\PartnerLoginController@showLoginForm'
    ]);

    Route::post('login', [
    'as' => 'partner.login.submit',
    'uses' => 'Auth\PartnerLogInController@login'
    ]);

    Route::get('/', [
        'as' => 'partner.dashboard',
        'uses' =>'Partner\PartnerController@index'
    ]);

    Route::get('/redeem', 'PromotionController@redeem');

    Route::get('campaigns/{campaign}', [

        'as' => 'partner.campaigns.show',
        'uses' => 'CampaignController@show'
    ]);

    Route::get('/account', [

        'as' => 'partner.account',
        'uses' => 'Partner\PartnerController@show'
    ]);

});

/* admin routes*/
Route::group(['prefix' => 'admin'],function(){

    Route::get('login', [
    'as' => 'admin.login',
    'uses' => 'Auth\AdminLogInController@showLoginForm'
    ]);

    Route::post('login', [
    'as' => 'admin.login.submit',
    'uses' => 'Auth\AdminLogInController@login'
    ]);

    Route::get('/', [
        'as' => 'admin.dashboard',
        'uses' =>'Admin\AdminController@index'
    ]);

     /* Admin Users */
    Route::get('users', [

        'as' => 'admin.users',
        'uses' => 'User\UserController@index'
    ]);

     Route::get('users/{user}', [

        'as' => 'admin.users.show',
        'uses' => 'User\UserController@show'
    ]);

     Route::post('users/{user}/deactivate', [

        'as' => 'admin.users.deactivate',
        'uses' => 'Admin\AdminUserController@deactivate'
    ]);

     Route::post('users/{user}/activate', [

        'as' => 'admin.users.activate',
        'uses' => 'Admin\AdminUserController@activate'
    ]);

    /* Admin Campaigns */

    Route::get('campaigns', [

        'as' => 'admin.campaigns',
        'uses' => 'CampaignController@index'
    ]);

    Route::get('/campaigns/create', 'CampaignController@create');

    Route::post('campaigns', [

        'as' => 'admin.campaigns',
        'uses' => 'CampaignController@store'
    ]);

    Route::get('campaigns/{campaign}', [

        'as' => 'admin.campaigns.show',
        'uses' => 'CampaignController@show'
    ]);

    Route::get('campaigns/{campaign}/edit', [
        'as' => 'admin.campaigns.edit',
        'uses' =>'CampaignController@edit'

    ]);

    Route::put('campaigns/{campaign}', [
        'as' => 'admin.campaigns.update',
        'uses' =>'CampaignController@update'

    ]);

    Route::delete('campaigns/{campaign}', [
        'as' => 'admin.campaigns.destroy',
        'uses' =>'CampaignController@destroy'

    ]);


    /* Admin Restaurant */

    Route::get('restaurants', [
        'as' => 'admin.restaurants',
        'uses' => 'RestaurantsController@index'
    ]);

    Route::post('restaurants', [
        'as' => 'admin.restaurants',
        'uses' => 'RestaurantsController@store'
    ]);

    Route::get('restaurants/create', [
        'as' => 'admin.restaurants.create',
        'uses' =>'RestaurantsController@create'

    ]);


    Route::put('restaurants/{restaurant}', [
        'as' => 'admin.restaurants.update',
        'uses' => 'RestaurantsController@update'
    ]);

    Route::delete('restaurants/{restaurant}', [
        'as' => 'admin.restaurants.destroy',
        'uses' => 'RestaurantsController@destroy'
    ]);

    Route::get('restaurants/{restaurant}', [
        'as' => 'admin.restaurants.show',
        'uses' =>'RestaurantsController@show'

    ]);

    Route::get('restaurants/{restaurant}/edit', [
        'as' => 'admin.restaurants.edit',
        'uses' => 'RestaurantsController@edit'
    ]);

    /* Admin manager */
    Route::get('admins', [
        'as' => 'admin.admins',
        'uses' => 'Admin\AdminController@list'
    ]);

    Route::get('admins/create', [
        'as' => 'admin.admins.create',
        'uses' => 'Admin\AdminController@create'
    ]);

    Route::Post('admins/store', [
        'as' => 'admin.admins.store',
        'uses' => 'Admin\AdminController@store'
    ]);

    Route::delete('admins/{admin}', [

        'as' => 'admin.admins.destroy',
        'uses' => 'Admin\AdminController@destroy'

    ]);

    /* admin Requirements */
    //requirement routes
    Route::resource('requirements', 'RequirementController', ['except' => ['create']]);

});


//auth routes automatically put by laravel
Auth::routes();

/* User routes */
Route::get('/home', 'HomeController@index');

Route::get('home/campaigns/{campaign}', [

    'as' => 'home.campaigns.show',
    'uses' => 'CampaignController@show'

]);

Route::get('home/{user}/edit', [
    'as' => 'home.user.edit',
    'uses' => 'User\UserController@edit'
]);

  Route::put('home/{user}', [

    'as' => 'home.user.update',
    'uses' => 'User\UserController@update'
]);

Route::post('get/code', [

    'as' => 'get.code',
    'uses' => 'User\UserController@code'

]);



Route::get('markNotificationsAsRead','User\UserController@markNotificationsAsRead');



// testing
/*Route::get('/postcode', function(){
    $data = Postcode::postcodeLookup('n15 6jd');
    print_r($data);
    return null;
});*/

/*Route::get('/logs', function(){

    Illuminate\Support\Facades\Log::info('restaurant_name_ajax: '. 'route');
});*/