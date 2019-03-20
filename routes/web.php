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

Route::get('/' , 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get ('/products/{id}','ProductController@show');
Route::post ('/cart','CartDetailController@store');// Registrar
Route::delete ('/cart','CartDetailController@destroy');
Route::post ('/order','CartController@update');

Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function () {
    
    Route::get ('/products','ProductController@index');// listado de productos
    Route::get ('/products/create','ProductController@create');// crear productos
    Route::post ('/products','ProductController@store');// Registrar
    Route::get ('/products/{id}/edit','ProductController@edit');// Formulario de edicion
    Route::post ('/products/{id}/edit','ProductController@update');// actualizar
    Route::post ('/products/{id}/delete','ProductController@destroy');// formulario para eliminar


    Route::get ('/products/{id}/images','ImageController@index');// Formulario de imagenes
    Route::post ('/products/{id}/images','ImageController@store');// Registrar
    Route::delete ('/products/{id}/images','ImageController@destroy');// formulario para eliminar
    Route::get ('/products/{id}/images/select/{image}','ImageController@select');// Destacar una imagen
    
    Route::get ('/categories','CategoryController@index');// listado de Category
    Route::get ('/categories/create','CategoryController@create');// crear Category
    Route::post ('/categories','CategoryController@store');// Registrar
    Route::get ('/categories/{category}/edit','CategoryController@edit');// Formulario de edicion
    Route::post ('/categories/{category}/edit','CategoryController@update');// actualizar
    Route::delete  ('/categories/{category}/delete','CategoryController@destroy');// formulario para eliminar


});


