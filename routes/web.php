<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\PinjamanController;

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
Route::prefix('perusahaan')->name('perusahaan.')->group(function () {

    Route::get('/sejarah', function () {
        return view('pages.perusahaan.sejarah');
    })->name('sejarah');

    Route::get('/visi-misi', function () {
        return view('pages.perusahaan.visi-misi');
    })->name('visi-misi');

    Route::get('/budaya-perusahaan', function () {
        return view('pages.perusahaan.budaya-perusahaan');
    })->name('budaya');

    Route::get('/struktur-organisasi', function () {
        return view('pages.perusahaan.struktur-organisasi');
    })->name('struktur');

    Route::get('/dewan-komisaris', function () {
        return view('pages.perusahaan.dewan-komisaris');
    })->name('komisaris');

    Route::get('/direksi', function () {
        return view('pages.perusahaan.direksi');
    })->name('direksi');

    Route::get('/tata-kelola', function () {
        return view('pages.perusahaan.tata-kelola');
    })->name('tata-kelola');

});