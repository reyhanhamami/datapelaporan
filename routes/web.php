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

// Route::get('/', function () {
//     return view('auth.login');
// });
// route untuk login
    Route::get('/login', 'LoginController@getLogin')->name('login');
    Route::post('/login', 'LoginController@login')->name('postLogin');
     // route untuk logout
    Route::get('logout', 'LoginController@logout')->name('logout')->middleware('auth');
// route password
// Auth::routes([
//     'register' => false,
// ]);

// route dashboard
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
});

// route data keuagan
Route::group(['middleware' => ['auth']], function(){
    Route::get('/keuangan', 'keuanganController@index')->name('keuangan');
    Route::get('/keuangan/bukti/{tdonasi}', 'keuanganController@getbukti');
    Route::patch('/keuangan/inputbukti/{bukti_pembayaran}', 'keuanganController@inputbukti');
    Route::get('/keuangan/validasipembayaran/{bukti_pembayaran}','keuanganController@validasipembayaran');
    Route::patch('/keuangan/prosesvalidasi/{bukti_pembayaran}','keuanganController@prosesvalidasi');
    Route::get('/keuangan/notifpembayaran','keuanganController@notifpembayaran')->name('notifpembayaran');
});

// route data edc 
Route::group(['middleware' => ['auth']], function(){
    Route::get('/DataEdc','stock_movementController@index')->name('dataedc');
    Route::get('/inputbuktitransfer','stock_movementController@inputtransfer')->name('inputtransfer');
    Route::post('/savebuktitransfer','stock_movementController@savebuktitransfer')->name('savebuktitransfer');
    Route::delete('deletebuktitransfer/{z_trf}','stock_movementController@deletebuktitransfer');
    Route::get('/buktitransfer','stock_movementController@buktitransfer')->name('buktitransfer');
    Route::get('/buktitransfer/{id}', 'stock_movementController@geteditbuktitransfer')->name('geteditbuktitransfer');
    Route::post('/buktitransfer/sip', 'stock_movementController@postbuktitransfer')->name('postbuktitransfer');
    Route::get('/jsonbuktitransfer','stock_movementController@jsonbuktitransfer')->name('jsonbuktitransfer');
    Route::post('/inputbuktitransfer','stock_movementController@zsimpan')->name('zsimpan');
    Route::get('/carinama','stock_movementController@carinama');
    Route::get('/getvaluenama','stock_movementController@getvaluenama');
    Route::get('/transaksipertanggal/{tgl}','stock_movementController@transaksipertanggal');
    Route::get('/jsontransaksipertanggal/{tgl}','stock_movementController@json_transaksipertanggal');
    Route::get('/verifotomatis/{no_kwitansi}/{id_tr}/{agen}/{cabang}','stock_movementController@verifotomatis');
    Route::get('/editpengesahandonasi/{pengesahan}','stock_movementController@editpengesahandonasi');
    Route::get('/cekperverifikasi/{id}/{tgl}/{tanggal}/{jmh}/{sumber}','stock_movementController@cekperverifikasi');
    Route::patch('/editpengesahandonasi/edit/{no_kwitansi}','stock_movementController@updatepengesahan');
    Route::get('/tdonasidetaileditkd/{kd}','stock_movementController@tdonasidetaileditkd');
    Route::post('/tdonasidetaileditkdupdate','stock_movementController@tdonasidetaileditkdupdate')->name('tdonasi.update');
    Route::post('/tdonasidetaildelete/{kd}','stock_movementController@tdonasidetaildelete')->name('tdonasi.delete');
    Route::post('/uploadz_trf','stock_movementController@upload')->name('edc.upload');
    Route::post('/uploadz_trf_aja','stock_movementController@upload_aja')->name('edc.upload_aja');
    // Route::patch('/tdonasidetaileditkdupdate/{kd}','stock_movementController@tdonasidetaileditkdupdate')->name('tdonasi.update');
});

// route untuk donasi 
Route::group(['middleware' => ['auth']], function(){
    Route::get('/donasi', 'donasiController@index')->name('donasi');
    Route::get('/carihp','donasiController@carihp')->name('carihp');
    Route::get('/cariemail','donasiController@cariemail')->name('cariemail');
    Route::post('/carinokwitansi', 'donasiController@carinokwitansi')->name('carinokwitansi');
    Route::post('/cariduphp', 'donasiController@cariduphp')->name('cariduphp');
    Route::post('/caridupemail', 'donasiController@caridupemail')->name('caridupemail');
    Route::get('/getvaluewakif','donasiController@getvaluewakif')->name('valuewakif');
    Route::post('donasi/storedonasi','donasiController@store')->name('storedonasi');
    Route::get('donasi/tabledonasi', 'donasiController@tabledonasi')->name('tabledonasi');
    Route::get('deletedonasi/{no_kwitansi}', 'donasiController@deletedonasi')->name('deletedonasi');
    Route::get('uploadweb/{no_kwitansi}', 'donasiController@uploadweb')->name('uploadweb');
    Route::post('getcabang', 'donasiController@getcabang')->name('getcabang');
    Route::post('getdana', 'donasiController@getdana')->name('getdana');
});

// route untuk verifikasi transfer ac_tbuku_bank 
Route::group(['middleware' => ['auth']], function(){
    Route::get('/verifikasiTransfer','ac_tbuku_bankController@index')->name('verifikasi');
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

// route wakif 
Route::group(['middleware' => ['auth']], function(){
    Route::get('/wakif','wakifController@index')->name('wakif');
    Route::get('/jsonwakif','wakifController@jsonwakif')->name('jsonwakif');
    Route::get('/wakif/history/{customerno}','wakifController@historywakif')->name('historywakif');
    Route::get('/wakif/tes','wakifController@tes')->name('tes');
    Route::get('/wakif/urlpdf/{customerno}/{tgl}','wakifController@urlpdf')->name('urlpdf');
});

