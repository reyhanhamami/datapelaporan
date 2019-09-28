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
    return view('auth.login');
});

// route password
Auth::routes();

// route dashboard
Route::get('/home', 'HomeController@index')->name('home');

// route data keuagan

// route add stock
Route::get('barang','barangController@index')->name('barang');

// route master customer 
Route::get('customer','customerController@index')->name('customer');
Route::get('customer/add','customerController@create')->name('addcustomer');
Route::post('customer/add','customerController@store')->name('storecustomer');
Route::delete('customer/{customer}','customerController@destroy');
Route::get('customer/edit/{customer}','customerController@edit');
Route::patch('customer/edit/{customer}','customerController@update');

// route master vendor 
Route::get('vendor', 'vendorController@index')->name('vendor');

// route master expedisi
Route::get('expedisi','expedisiController@index')->name('expedisi');
Route::get('expedisi/add','expedisiController@create')->name('addexpedisi');
Route::post('expedisi/add','expedisiController@store')->name('storeexpedisi');
Route::delete('expedisi/{expedisi}','expedisiController@destroy');
Route::get('expedisi/{expedisi}','expedisiController@edit');
Route::patch('expedisi/edit/{expedisi}','expedisiController@update');

// route master e-commerce
Route::get('ecommerce', 'ecommerceController@index')->name('ecommerce');
Route::get('ecommerce/add', 'ecommerceController@create')->name('add');
Route::get('ecommerce/edit/{ecommerce}', 'ecommerceController@edit');
Route::patch('ecommerce/edit/{ecommerce}', 'ecommerceController@update');
Route::post('ecommerce/add', 'ecommerceController@store')->name('store');
Route::delete('ecommerce/{ecommerce}', 'ecommerceController@destroy');

// route master reseller
Route::get('reseller', 'resellerController@index')->name('reseller');

// route untuk reseller input pesanan 
Route::get('pesanan', function(){
    return view('pesanan.pesanan');
});