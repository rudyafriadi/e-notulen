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
Auth::routes();

Route::get('/signin','LoginController@index')->middleware('guest');
Route::post('/signin','LoginController@postsignin')->name('signin');
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/export-pdf', 'HomeController@exportPDF');

Route::prefix('datanotulen')->group(function(){
    Route::get('/', 'NotulenController@index')->name('notulen')->middleware('auth');
    Route::post('/daftar','NotulenController@postRegister')->name('daftar');
    Route::get('/edit/{id}','NotulenController@edit');
    Route::post('/update/{id}','NotulenController@update');
    Route::get('/delete/{id}','NotulenController@delete');
    // Route::get('/search','NotulenController@search')->name('search');
});

Route::prefix('instansi')->group(function(){
    Route::get('/', 'AgencyController@index')->name('instansi')->middleware('auth');
    Route::post('/simpan','AgencyController@save');
    Route::get('/edit/{id}','AgencyController@edit');
    Route::post('/update/{id}','AgencyController@update');
    Route::get('/delete/{id}','AgencyController@delete');
    Route::get('/export-pdf', 'AgencyController@exportPDF');
});

// Route::prefix('pegawai')->group(function(){
//     Route::get('/', 'EmployeeController@index')->name('pegawai');
//     Route::post('/simpan','EmployeeController@save');
//     Route::get('/edit/{id}','EmployeeController@edit');
//     Route::post('/update/{id}','EmployeeController@update');
//     Route::get('/delete/{id}','EmployeeController@delete');
// });
    
Route::prefix('datahasilnotulen')->group(function(){
    Route::get('/', 'DatanotulenController@index')->name('datahasilnotulen')->middleware('auth');
    Route::post('/simpan','DatanotulenController@save');
    Route::get('/edit/{id}','DatanotulenController@edit');
    Route::post('/update/{id}','DatanotulenController@update');
    Route::get('/delete/{id}','DatanotulenController@delete');
    Route::get('/view/{id}','DatanotulenController@view');
    Route::put('/insertfile/{id}','DatanotulenController@insertfile');
    
    // Route::get('/search','NotulenController@search')->name('search');
});

Route::prefix('laporan')->group(function(){
    Route::get('/', 'ReportController@index')->name('laporan')->middleware('auth');
    Route::get('/export-pdf', 'ReportController@exportPDF')->name('export');
});
