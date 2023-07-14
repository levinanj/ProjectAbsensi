<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda.
| Rute-rute ini akan dimuat oleh RouteServiceProvider dalam sebuah grup yang
| berisi grup middleware "web". Sekarang buatlah sesuatu yang hebat!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', function () {
    abort(404);
})->name('home');


Route::group(['middleware' => 'role:Admin', 'namespace' => 'Kelola', 'prefix' => 'kelola'], function () {

    Route::get('/dasbor', 'MainController@index')->name('dashboard');

    // Kehadiran siswa
    Route::get('/siswa/{siswa}/kehadiran', 'SiswaController@kehadiran')->name('siswa.kehadiran');
    // Ketidakhadiran siswa
    Route::get('/siswa/{siswa}/ketidakhadiran', 'SiswaController@ketidakhadiran')->name('siswa.ketidakhadiran');
    // Sumber Daya Siswa
    Route::resource('/siswa', 'SiswaController')->except('create', 'edit');

    // Menuju halaman penugasan siswa untuk mata pelajaran
    Route::get('/mata-pelajaran/{mata_pelajaran}/penugasan', 'MapelController@penugasanSiswa')->name('mata_pelajaran.penugasan-siswa');
    // Simpan siswa yang ditugaskan ke database
    Route::post('/mata-pelajaran/{mata_pelajaran}/lampirkan', 'MapelController@lampirkanSiswa')->name('mata_pelajaran.lampirkan-siswa');
    // Hapus siswa yang ditugaskan dari database
    Route::delete('/mata-pelajaran/{mata_pelajaran}/lepas/{siswa}', 'MapelController@lepasSiswa')->name('mata_pelajaran.hapus.siswa');
    // Sumber Daya Mata Pelajaran
    Route::resource('/mata-pelajaran', 'MapelController')->except('create', 'edit');

    // Lampirkan catatan kehadiran siswa
    Route::post('kehadiran/lampirkan/{kehadiran}', 'KehadiranCOntroller@lampirkanSiswa')->name('kehadiran.lampirkan');
    // Perbarui catatan kehadiran siswa
    Route::put('kehadiran/lampirkan/{kehadiran}/perbarui', 'KehadiranCOntroller@perbaruiDataKehadiran')->name('kehadiran.siswa.perbarui');
    // Sumber Daya Kehadiran
    Route::resource('kehadiran', 'KehadiranCOntroller');

});
