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

Route::get('/', function () {
    return redirect('/products');
});


Route::get('/category/{category}','CategoryController@show');


Route::get('/getAttribute/{sku}','AttributesController@Index');
Route::get('/attributes/{attribute}','AttributesController@show');


Route::apiResource('products','ProductsController');

Route::apiResource('users','UsersController');

Route::post('/customers/saveMemory','CustomersController@saveMemory')->name('customers.saveMemory');
Route::post('/customers/removeMemory','CustomersController@removeMemory')->name('customers.removeMemory');

Route::post('/customers','CustomersController@store')->name('customers.store');

Auth::routes();
