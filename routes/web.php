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

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::get('/home', 'HomeController@index')->name('home');

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

$this->get('state', 'MasterController@getState');
$this->get('district/{id}', 'MasterController@getDistrict');
$this->get('area/{id}', 'MasterController@getArea');

Route::group(['middleware' => ['auth']], function () {

    // User Management
    Route::get('user/add', 'UserController@create')->name('user.register');
    Route::post('user', 'UserController@store')->name('user.create');
    Route::get('user', 'UserController@index')->name('user.list');
    Route::get('user/{id}/activate', 'UserController@activate')->name('user.activate');

    // Inventory Item Management
    Route::get('inventory/item', 'ItemController@index')->name('inventory.item');
    Route::post('inventory/item', 'ItemController@store')->name('inventory.item.create');

    // Inventory Stock Management
    Route::get('inventory/stock', 'ItemController@stock')->name('inventory.stock.list');
    Route::get('inventory/stock-camp', 'ItemController@campStock')->name('inventory.stock.camp');

    // Route::prefix('session-api')->group(function () {
    //     // Inventory API Routes
    //     Route::get('category', ['as' => 'inventory.category', 'uses' => 'CategoryController@index']);
    //     Route::post('category', ['as' => 'inventory.category.create', 'uses' => 'CategoryController@create']);
    //     Route::get('item', ['as' => 'inventory.item', 'uses' => 'ItemController@index']);
    //     Route::post('item', ['as' => 'inventory.item.create', 'uses' => 'ItemController@create']);
    //     Route::get('item/{id}/{camp}', ['as' => 'inventory.stock', 'uses' => 'ItemController@stock']);
    //     Route::put('item/{id}/{camp}', ['as' => 'inventory.stock.update', 'uses' => 'ItemController@stockUpdate']);
    //     // Route::get('camp/{camp}', ['as' => 'inventory.stock.camp', 'uses' => 'ItemController@campStock']);
    // });

    Route::prefix('views')->group(function () {
        Route::get('login', 'ViewController@getLogin');
        Route::get('index', 'ViewController@getIndex');
        Route::get('register', 'ViewController@getRegister');
        Route::get('users', 'ViewController@getUsersList');
        Route::get('inventory/add', 'ViewController@getInventoryAdd');
        Route::get('inventory/camps', 'ViewController@getInventoryCamps');
    });

});
