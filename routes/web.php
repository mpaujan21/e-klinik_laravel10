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
  
//   // Dokter
//   Route::middleware(['dokter'])->group(function () {
    Route::get('/rm/input', 'RMController@input_rm')->name('rm.input');
  
    Route::get('/rm/input/{idpasien}', 'RMController@input_rmid')->name('rm.input.id');

    Route::get('/rm/edit/{id}', 'RMController@edit_rm')->name('rm.edit');
    
    Route::post('/rm/simpan/', 'RMController@simpan_rm')->name('rm.simpan');

    Route::delete('/rm/hapus/{id}','RMController@hapus_rm')->name('rm.hapus');
//   });

//   // Riwayat RM
//   Route::middleware(['rekam_medis'])->group(function () {
    Route::get('/rm/riwayat', 'RMController@riwayat_rm')->name('rm.riwayat');
    
    Route::get('/rm/riwayat/{idpasien}', 'RMController@riwayat_rmid')->name('rm.riwayat.id');

    Route::get('/rm/lihat/{id}', 'RMController@lihat_rm')->name('rm.lihat');
//   });

//   // Admin Lab
//   Route::middleware(['lab'])->group(function () {
    Route::get('/lab', 'LabController@index')->name('lab');

    Route::get('/hasil_lab', 'LabController@hasil_lab')->name('lab.hasil');

    Route::get('/lab/input/{id}', 'LabController@input_hasil_lab')->name('lab.input');

    Route::post('/lab/simpan/', 'LabController@simpan_hasil_lab')->name('lab.simpan');
//   });

//   // Admin Farmasi
//   Route::middleware(['farmasi'])->group(function () {
    Route::get('/obat', 'ObatController@index')->name('obat');
  
    Route::get('/obat/tambah/', 'ObatController@tambah_obat')->name('obat.tambah');
    
    Route::get('/obat/edit/{id}', 'ObatController@edit_obat')->name('obat.edit');
    
    Route::post('/obat/edit/update/', 'ObatController@update_obat')->name('obat.update');
    
    Route::post('/obat/tambah/simpan', 'ObatController@simpan_obat')->name('obat.simpan');
    
    Route::delete('/obat/hapus/{id}','ObatController@hapus_obat')->name('obat.hapus');
    
    Route::get('/obat/export_excel', 'ObatController@export_excel')->name('obat.export_excel');
    
    Route::get('/obat/excel', 'ObatController@excel')->name('obat.excel');
    
    Route::post('/obat/import_excel', 'ObatController@import_excel')->name('obat.import_excel');
//   });
  
//   // Pendaftaran
//   Route::middleware(['pasien'])->group(function () {
    Route::get('/pendaftaran', 'DaftarController@index')->name('pendaftaran');
  
    Route::get('/jadwal','JadwalController@jadwal_pasien')->name('jadwal.pasien');

    Route::post('/pendaftaran', 'DaftarController@daftar_kunjungan')->name('pendaftaran.input');

    Route::delete('/jadwal/hapus/{id}','DaftarController@hapus_kunjungan')->name('jadwal.hapus');
//   });
  
  
//   // TODO Hapus
  Route::get('/', 'MainController@index')->name('dashboard')->middleware('auth');
//   Route::get('/rm/list/{idpasien}', 'RMController@list_rm')->name('rm.list')->middleware('auth');
//   Route::delete('/rm/destroy/{id}','RMController@hapus_rm')->name('rm.destroy')->middleware('auth');
//   Route::post('/rm/update/', 'RMController@update_rm')->name('rm.update')->middleware('auth');
});


// //================================================================

// // //Pasien
// // Route::get('/pasien', 'PasienController@index')->name('pasien')->middleware('auth');

// // Route::get('/pasien/tambah/', 'PasienController@tambah_pasien')->name('pasien.tambah')->middleware('auth');

// // Route::post('/pasien/tambah/simpan', 'PasienController@simpan_pasien')->name('pasien.simpan')->middleware('auth');

// // Route::post('/pasien/edit/update/', 'PasienController@update_pasien')->middleware('auth');

// // Route::delete('/pasien/hapus/{id}','PasienController@hapus_pasien')->name('pasien.destroy')->middleware('auth');

// // Route::get('/pasien/edit/{id}','PasienController@edit_pasien')->name('pasien.edit')->middleware('auth');
// // //End Pasien

// // //Lab
// // // Route::get('/lab', 'LabController@index')->name('lab')->middleware('auth');

// // Route::delete('/lab/hapus/{id}','LabController@hapus_lab')->name('lab.destroy')->middleware('auth','staff');

// // // Route::get('/lab/edit/{id}', 'LabController@edit_lab')->name('lab.edit')->middleware('auth','staff');

// // Route::get('/lab/tambah', 'LabController@tambah_lab')->name('lab.tambah')->middleware('auth','staff');

// // // Route::post('/lab/tambah/simpan', 'LabController@simpan_lab')->name('lab.simpan')->middleware('auth','staff');

// // Route::post('/lab/edit/update/', 'LabController@update_lab')->name('lab.update')->middleware('auth','staff');
// // //End Lab

// // //RM
// // Route::get('/rm', 'RMController@index')->name('rm')->middleware('auth');

// // Route::delete('/rm/destroy/{id}','RMController@hapus_rm')->name('rm.destroy')->middleware('auth');

// // // Route::get('/rm/edit/{id}', 'RMController@edit_rm')->name('rm.edit')->middleware('auth');

// // Route::get('/rm/tambah', 'RMController@tambah_rm')->name('rm.tambah')->middleware('auth');

// // Route::get('/rm/tambah/{idpasien}', 'RMController@tambah_rmid')->name('rm.tambah.id')->middleware('auth');

// // // Route::post('/rm/simpan/', 'RMController@simpan_rm')->name('rm.simpan')->middleware('auth');

// // Route::post('/rm/update/', 'RMController@update_rm')->name('rm.update')->middleware('auth');

// // Route::get('/rm/list/{idpasien}', 'RMController@list_rm')->name('rm.list')->middleware('auth');

// // // Route::get('/rm/lihat/{id}', 'RMController@lihat_rm')->name('rm.lihat')->middleware('auth');
// // //End RM

// // //Tagihan
// // Route::get('/tagihan/{id}', 'RMController@tagihan')->name('tagihan')->middleware('auth');
// // //Endtagihan

// // //Pengaturan
// // Route::get('/pengaturan', 'PengaturanController@index')->name('pengaturan')->middleware('auth','admin');

// // Route::patch('/pengaturan/simpan', 'PengaturanController@simpan')->name('pengaturan.simpan')->middleware('auth','admin');
// // //End Pengaturan

//Profile
Auth::routes([
  'register' => true,
  'verify' => false,
  'reset' => false
]);

Route::group(['prefix' => 'users'], function(){
  Route::auth();
});

// Route::get('users/profile', 'ProfileController@index')->name('profile.edit')->middleware('auth');

// Route::get('users/profile/{id}', 'ProfileController@edit')->name('profile.edit.admin')->middleware('auth','admin');

// Route::patch('users/profile/simpan', 'ProfileController@simpan')->name('profile.simpan')->middleware('auth');
// //endProfile

// //Users
// Route::get('/users', 'UserController@index')->name('user')->middleware('auth','admin');

// Route::delete('/users/delete/{id}', 'UserController@hapus')->name('user.destroy')->middleware('auth','admin');
// //endUsers