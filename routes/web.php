<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
    }
);

Route::group(['middleware' => ['auth']], function () {
  Route::get('/', 'MainController@index')->name('dashboard')->middleware('auth');
  
  // Dokter
  Route::middleware(['dokter'])->group(function () {
    Route::get('/rm/input', 'RMController@input_rm')->name('rm.input');
  
    Route::get('/rm/input/{idpasien}', 'RMController@input_rmid')->name('rm.input.id');

    Route::get('/rm/edit/{id}', 'RMController@edit_rm')->name('rm.edit');
    
    Route::post('/rm/simpan/', 'RMController@simpan_rm')->name('rm.simpan');

    Route::delete('/rm/hapus/{id}','RMController@hapus_rm')->name('rm.hapus');
  });

  // Riwayat RM
  Route::middleware(['rekam_medis'])->group(function () {
    Route::get('/rm/riwayat', 'RMController@riwayat_rm')->name('rm.riwayat');
    
    Route::get('/rm/riwayat/{idpasien}', 'RMController@riwayat_rmid')->name('rm.riwayat.id');

    Route::get('/rm/lihat/{id}', 'RMController@lihat_rm')->name('rm.lihat');
  });

  // Admin Lab
  Route::middleware(['lab'])->group(function () {
    Route::get('/lab', 'LabController@index')->name('lab');

    Route::get('/hasil_lab', 'LabController@hasil_lab')->name('lab.hasil');

    Route::get('/lab/input/{id}', 'LabController@input_hasil_lab')->name('lab.input');

    Route::post('/lab/simpan/', 'LabController@simpan_hasil_lab')->name('lab.simpan');
  });

  // Admin Farmasi
  Route::middleware(['farmasi'])->group(function () {
    Route::get('/obat', 'ObatController@index')->name('obat');
  
    Route::get('/obat/tambah/', 'ObatController@tambah_obat')->name('obat.tambah');
    
    Route::get('/obat/edit/{id}', 'ObatController@edit_obat')->name('obat.edit');
    
    Route::post('/obat/edit/update/', 'ObatController@update_obat')->name('obat.update');
    
    Route::post('/obat/tambah/simpan', 'ObatController@simpan_obat')->name('obat.simpan');
    
    Route::delete('/obat/hapus/{id}','ObatController@hapus_obat')->name('obat.hapus');
    
    Route::get('/obat/export_excel', 'ObatController@export_excel')->name('obat.export_excel');
    
    Route::get('/obat/excel', 'ObatController@excel')->name('obat.excel');
    
    Route::post('/obat/import_excel', 'ObatController@import_excel')->name('obat.import_excel');
  });
  
  // Pendaftaran
  Route::middleware(['pasien'])->group(function () {
    Route::get('/pendaftaran', 'DaftarController@index')->name('pendaftaran');
  
    Route::get('/jadwal','JadwalController@jadwal_pasien')->name('jadwal.pasien');

    Route::post('/pendaftaran', 'DaftarController@daftar_kunjungan')->name('pendaftaran.input');

    Route::delete('/jadwal/hapus/{id}','DaftarController@hapus_kunjungan')->name('jadwal.hapus');
  });
});

//Profile
Auth::routes([
  'register' => true,
  'verify' => false,
  'reset' => false
]);

Route::group(['prefix' => 'users'], function(){
  Route::auth();
});