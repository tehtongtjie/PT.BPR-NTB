<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\crypt;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\Admin\AdminAuthController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA (PUBLIC USER)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('users.pages.home');
})->name('home');
/*
|--------------------------------------------------------------------------
| ADMIN PANEL (DASHBOARD + CRUD)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/create', [ArticleController::class, 'create']);
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit']);
    Route::put('/articles/{article}', [ArticleController::class, 'update']);
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy']);

    Route::get('/logout', [AdminAuthController::class, 'logout']);
});

// login admin (POST)
Route::post('/admin/{token}', [AdminAuthController::class, 'login'])
    ->name('admin.auth.login');



// Path admin secured access
Route::get('/admin/{pathToken?}', function (Request $request, $pathToken = null) {

    if ($request->query('token')) {

        $plainToken = $request->query('token');

        if ($plainToken !== 'abcd') {
            abort(404);
        }
        $encodedToken = Crypt::encryptString($plainToken);

        return redirect('/admin/' . urlencode($encodedToken));
    }

    if ($pathToken) {
        try {
            $decoded = Crypt::decryptString($pathToken);

            if ($decoded !== 'abcd') {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }

        // dibagian return view ini ganti jadi admin dashboard
        return view('admin.auth.login');
    }

    abort(404);
});


/*
|--------------------------------------------------------------------------
| HALAMAN SIMULASI (AWAL)
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
| FORM PERMINTAAN INFORMASI SIMULASI
|--------------------------------------------------------------------------
*/
Route::get('/simulasi/{jenis}/permintaan', function ($jenis) {

    if (!in_array($jenis, ['deposito', 'kredit'])) {
        abort(404);
    }

    return view('users.simulasi.permintaan-simulasi', compact('jenis'));

})->name('simulasi.permintaan');

/*
|--------------------------------------------------------------------------
| SUBMIT FORM PERMINTAAN SIMULASI
|--------------------------------------------------------------------------
*/
Route::post(
    '/simulasi/permintaan/submit',
    [SimulasiController::class, 'submit']
)->name('simulasi.permintaan.submit');

/*
|--------------------------------------------------------------------------
| DEPOSITO (INFORMASI – TANPA DATABASE)
|--------------------------------------------------------------------------
*/
Route::get('/deposito', function () {
    return view('users.deposito.show');
})->name('deposito.show');

/*
|--------------------------------------------------------------------------
| TABUNGAN (INFORMASI – VIA CONTROLLER)
|--------------------------------------------------------------------------
*/
Route::get(
    '/tabungan/{slug}',
    [TabunganController::class, 'show']
)->name('tabungan.show');

/*
|--------------------------------------------------------------------------
| PINJAMAN (INFORMASI – VIA CONTROLLER)
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
| HALAMAN PROFIL / PERUSAHAAN
|--------------------------------------------------------------------------
*/
Route::get(
    '/perusahaan/{slug}',
    [PerusahaanController::class, 'show']
)->name('perusahaan.show');


