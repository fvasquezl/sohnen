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
//Route::name('api.')->group(function (){
//    Route::apiResource('products','Api\ProductCatalogController');
//  //  Route::apiResource('roles','Api\RolesController');
//});
Route::name('api.')->group(function (){
    Route::apiResource('ams','Api\MerchantSKUController');
});

