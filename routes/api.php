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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('v1/wakif', 'stock_movementController@getapi');
Route::get('v1/ac_tbuku_bank', 'api\ac_tbuku_bankController@index')->name('ac_tbuku_bank');

// json z_trf 
Route::get('v1/z_trf','stock_movementController@jsonz_trf')->name('z_trf');

// api tdonasi 
Route::get('v1/tdonasi/{no_kwitansi}','stock_movementController@searchnokwitansi');

// json json_transaksipertanggal
Route::get('v1/transaksipertanggal/{tgl}','stock_movementController@json_transaksipertanggal')->name('transaksipertanggal');

// json tdonasi 
Route::get('v1/jsontdonasi','donasiController@jsontdonasi')->name('jsontdonasi');