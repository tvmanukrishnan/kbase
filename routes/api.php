<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Inventory API Routes
Route::get('category', ['as' => 'api.inventory.category', 'uses' => 'Api\CategoryAPIController@index']);
Route::post('category', ['as' => 'api.inventory.category.create', 'uses' => 'Api\CategoryAPIController@store']);
Route::get('item', ['as' => 'api.inventory.item', 'uses' => 'Api\ItemAPIController@index']);
Route::post('item', ['as' => 'api.inventory.item.create', 'uses' => 'Api\ItemAPIController@store']);
Route::get('item/{id}/{camp}', ['as' => 'api.inventory.stock', 'uses' => 'Api\ItemAPIController@stock']);
Route::put('item/{id}/{camp}', ['as' => 'api.inventory.stock.update', 'uses' => 'Api\ItemAPIController@stockUpdate']);
// Route::get('camp/{camp}', ['as' => 'inventory.stock.camp', 'uses' => 'ItemController@campStock']);