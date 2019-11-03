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
Auth::routes([
    'register' => false,
]);

// route dashboard
Route::get('/home', 'HomeController@index')->name('home');

// route data keuagan

// route add stock barang
Route::group(['middleware' => ['auth']], function(){
Route::get('/barang','barangController@index')->name('barang');
Route::get('/barang/add','barangController@create')->name('addbarang');
Route::post('/barang/add','barangController@store')->name('storebarang');
Route::delete('/barang/delete/{barang}','barangController@destroy');
Route::get('/barang/edit/{barang}','barangController@edit');
Route::patch('/barang/edit/{barang}','barangController@update');
Route::get('/barang/cari', 'barangController@cari')->name('caribarang');
});

// route kategori   
Route::group(['middleware' => ['auth']], function(){
    Route::get('/barang/kategori', 'kategoriController@create')->name('addkategori');
    Route::post('/barang/kategori', 'kategoriController@store')->name('storekategori');
    Route::delete('/barang/kategori/hapus/{kategori}', 'kategoriController@destroy');
    Route::get('/barang/kategori/edit/{kategori}', 'kategoriController@edit');
    Route::patch('/barang/kategori/edit/{kategori}', 'kategoriController@update');
});

// route master customer 
Route::group(['middleware' => ['auth']], function(){
    Route::get('/customer','customerController@index')->name('customer');
    Route::get('customer/add','customerController@create')->name('addcustomer');
    Route::post('customer/add','customerController@store')->name('storecustomer');
    Route::delete('customer/{customer}','customerController@destroy');
    Route::get('customer/edit/{customer}','customerController@edit');
    Route::patch('customer/edit/{customer}','customerController@update');
    Route::get('customer/cari','customerController@cari')->name('caricustomer');
    Route::get('customer/exportExcel','customerController@exportExcel')->name('exportExcel');
});

// route master vendor 
Route::group(['middleware' => ['auth']], function(){
    Route::get('/vendor', 'vendorController@index')->name('vendor');
    Route::get('vendor/add', 'vendorController@create')->name('addvendor');
    Route::post('vendor/add', 'vendorController@store')->name('storevendor');
    Route::delete('vendor/{vendor}', 'vendorController@destroy');
    Route::get('vendor/edit/{vendor}', 'vendorController@edit');
    Route::patch('vendor/edit/{vendor}', 'vendorController@update');
    Route::get('vendor/cari', 'vendorController@cari')->name('carivendor');
});

// route master expedisi
Route::group(['middleware' => ['auth']], function(){
    Route::get('/expedisi','expedisiController@index')->name('expedisi');
    Route::get('expedisi/add','expedisiController@create')->name('addexpedisi');
    Route::post('expedisi/add','expedisiController@store')->name('storeexpedisi');
    Route::delete('expedisi/{expedisi}','expedisiController@destroy');
    Route::get('expedisi/{expedisi}','expedisiController@edit');
    Route::patch('expedisi/edit/{expedisi}','expedisiController@update');
});

// route master e-commerce
Route::group(['middleware' => ['auth']], function(){
    Route::get('/ecommerce', 'ecommerceController@index')->name('ecommerce');
    Route::get('ecommerce/add', 'ecommerceController@create')->name('add');
    Route::get('ecommerce/edit/{ecommerce}', 'ecommerceController@edit');
    Route::patch('ecommerce/edit/{ecommerce}', 'ecommerceController@update');
    Route::post('ecommerce/add', 'ecommerceController@store')->name('store');
    Route::delete('ecommerce/{ecommerce}', 'ecommerceController@destroy');
});

// route master reseller
Route::group(['middleware' => ['auth']], function(){
    Route::get('/reseller', 'resellerController@index')->name('reseller');
    Route::get('reseller/register', 'resellerController@register')->name('registerreseller');
    Route::post('reseller/register', 'resellerController@store')->name('storereseller');
    Route::delete('reseller/{user}', 'resellerController@destroy');
    Route::get('reseller/edit/{user}', 'resellerController@edit');
    Route::patch('reseller/edit/{user}', 'resellerController@update');
    Route::get('reseller/cari', 'resellerController@cari');
});

// route untuk reseller input pesanan 
Route::group(['middleware' => ['auth']], function(){
    Route::get('/order', 'orderController@index')->name('order');
    Route::get('/cari-telepon', 'orderController@caritelepon');
    Route::get('/getbarang', 'orderController@getbarang');
    Route::get('/caribarang', 'orderController@caribarang');
    Route::post('/order/add', 'orderController@store')->name('storeorder');
    // Route::get('/order', 'orderController@fetch')->name('fetch');
});

// route untuk status 
Route::group(['middleware' => ['auth']], function(){
    Route::get('/status_order', 'statusController@index')->name('status_order');
}); 