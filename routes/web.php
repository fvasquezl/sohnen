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
    return redirect('login');
});

Auth::routes();


//Route::get('/products', 'ProductsController@index')->name('products.index');
//Route::post('/products', 'ProductsController@store')->name('products.store');
//Route::get('/products/{product}', 'ProductsController@show')->name('products.show');
//Route::put('/products/{product}', 'ProductsController@update')->name('products.update');
//Route::delete('/products/{product}', 'ProductsController@destroy')->name('products.destroy');

Route::apiResource('products','ProductsController');

//Route::apiResource('/users','UsersController')->name('users');

Route::apiResource('users','UsersController');

