<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\DepositoController;
use App\Http\Controllers\PerusahaanController;

/*
|-------------------------------------------------------------------------- 
| HALAMAN UTAMA
|-------------------------------------------------------------------------- 
*/
Route::get('/', function () {
    return view('users.pages.home');
})->name('home');

/*
|-------------------------------------------------------------------------- 
| SIMULASI
|-------------------------------------------------------------------------- 
*/
Route::get('/simulasi/deposito', function () {
    return view('users.simulasi.deposito');
})->name('simulasi.deposito');

Route::get('/simulasi/kredit', function () {
    return view('users.simulasi.kredit');
})->name('simulasi.kredit');

/*
|-------------------------------------------------------------------------- 
| FORM PERMINTAAN SIMULASI
|-------------------------------------------------------------------------- 
*/
Route::get('/simulasi/{jenis}/permintaan', function ($jenis) {
    if (!in_array($jenis, ['deposito', 'kredit'])) {
        abort(404);
    }

    return view('users.simulasi.permintaan-simulasi', compact('jenis'));
})->name('simulasi.permintaan');

Route::post(
    '/simulasi/permintaan/submit',
    [SimulasiController::class, 'submit']
)->name('simulasi.permintaan.submit');

/*
|-------------------------------------------------------------------------- 
| DEPOSITO
|-------------------------------------------------------------------------- 
*/
Route::prefix('deposito')->group(function () {

    Route::get('/', [DepositoController::class, 'index'])
        ->name('deposito.index');

    Route::get('/{slug}', [DepositoController::class, 'show'])
        ->name('deposito.show');

});

/*
|-------------------------------------------------------------------------- 
| TABUNGAN
|-------------------------------------------------------------------------- 
*/
Route::get(
    '/tabungan/{slug}',
    [TabunganController::class, 'show']
)->name('tabungan.show');

/*
|-------------------------------------------------------------------------- 
| PINJAMAN
|-------------------------------------------------------------------------- 
*/
Route::get(
    '/pinjaman',
    [PinjamanController::class, 'index']
)->name('pinjaman.index');

Route::get(
    '/pinjaman/{slug}',
    [PinjamanController::class, 'show']
)->name('pinjaman.show');

/*
|-------------------------------------------------------------------------- 
| PENGADUAN (TANPA CONTROLLER)
|-------------------------------------------------------------------------- 
*/
Route::prefix('pengaduan')->group(function () {

    // ✅ Alur Pengaduan
    Route::get('/alur', function () {
        return view('users.pegaduan.alur-pengaduan');
    })->name('pengaduan.alur');

    // ✅ Whistle Blowing System
    Route::get('/whistle-blowing-system', function () {
        return view('users.pegaduan.WhistleBlowingSystem');
    })->name('pengaduan.wbs');

    // ✅ Submit WBS (dummy sementara)
    Route::post('/whistle-blowing-system', function () {
        return redirect()
            ->route('pengaduan.wbs')
            ->with('success', 'Laporan Anda berhasil dikirim. Terima kasih.');
    })->name('pengaduan.wbs.store');

});

/*
|-------------------------------------------------------------------------- 
| PERUSAHAAN – DETAIL
|-------------------------------------------------------------------------- 
*/
Route::get(
    '/perusahaan/komisaris/{slug}',
    [PerusahaanController::class, 'komisarisDetail']
)->name('perusahaan.komisaris.detail');

Route::get(
    '/perusahaan/direksi/{slug}',
    [PerusahaanController::class, 'direksiDetail']
)->name('perusahaan.direksi.detail');

/*
|-------------------------------------------------------------------------- 
| PERUSAHAAN – HALAMAN UMUM
|-------------------------------------------------------------------------- 
*/
Route::get(
    '/perusahaan/{slug}',
    [PerusahaanController::class, 'show']
)->name('perusahaan.show');
