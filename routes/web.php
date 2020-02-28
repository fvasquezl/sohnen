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


//Route::apiResource('users','UsersController');

Route::namespace('Products')->middleware('auth')->group(function(){
    Route::ApiResource('products','ProductsController');
    Route::get('products/admin','ProductsController@admin')->name('products.admin');
    Route::get('products/employee','ProductsController@admin')->name('products.employee');
    Route::post('products/merge','ProductsController@merge')->name('products.merge');
});

Route::namespace('Skus')->middleware('auth')->group(function(){
     Route::Resource('sku','SkuDetailsController');
});


Route::prefix('/admin')->namespace('Admin')->middleware('auth','role:admin')->group(function(){
    Route::resource('users','UsersController');
});


Route::post('/customers/saveMemory','CustomersController@saveMemory')->name('customers.saveMemory');
Route::post('/customers/removeMemory','CustomersController@removeMemory')->name('customers.removeMemory');

Route::get('/quotations','QuotationsController@index')->name('quotations.index');
Route::post('/quotations','QuotationsController@store')->name('quotations.store');
Route::delete('/quotations/{quotation}','QuotationsController@destroy')->name('quotations.destroy');

Route::get('/purchase','PurchaseController@index')->name('purchase.index');

Auth::routes();
