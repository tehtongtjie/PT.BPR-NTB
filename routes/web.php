<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PerusahaanController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.home');
});

/*
|--------------------------------------------------------------------------
| HALAMAN SIMULASI (AWAL)
|--------------------------------------------------------------------------
*/
Route::get('/simulasi/deposito', fn () => view('simulasi.deposito'))
    ->name('simulasi.deposito');

Route::get('/simulasi/kredit', fn () => view('simulasi.kredit'))
    ->name('simulasi.kredit');

/*
|--------------------------------------------------------------------------
| FORM PERMINTAAN INFORMASI SIMULASI
|--------------------------------------------------------------------------
*/
Route::get('/simulasi/{jenis}/permintaan', function ($jenis) {
    if (!in_array($jenis, ['deposito', 'kredit'])) {
        abort(404);
    }

    return view('simulasi.permintaan-simulasi', compact('jenis'));
})->name('simulasi.permintaan');

/*
|--------------------------------------------------------------------------
| SUBMIT FORM PERMINTAAN SIMULASI
|--------------------------------------------------------------------------
*/
Route::post('/simulasi/permintaan/submit',
    [SimulasiController::class, 'submit']
)->name('simulasi.permintaan.submit');

/*
|--------------------------------------------------------------------------
| TABUNGAN (INFORMASI – TANPA DATABASE)
|--------------------------------------------------------------------------
*/
Route::get('/tabungan/{slug}', [TabunganController::class, 'show'])
    ->name('tabungan.show');

    /*
|--------------------------------------------------------------------------
| PINJAMAN (INFORMASI – TANPA DATABASE)
|--------------------------------------------------------------------------
*/
Route::get('/pinjaman', [PinjamanController::class, 'index'])
    ->name('pinjaman.index');

Route::get('/pinjaman/{slug}', [PinjamanController::class, 'show'])
    ->name('pinjaman.show');

    /*
|--------------------------------------------------------------------------
| HALAMAN PROFIL / PERUSAHAAN
|--------------------------------------------------------------------------
*/
Route::get('/perusahaan/{slug}', [PerusahaanController::class, 'show'])
    ->name('perusahaan.show');
