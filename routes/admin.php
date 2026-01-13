<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| ADMIN DOMAIN (TERSEMBUNYI)
|--------------------------------------------------------------------------
*/

Route::domain('admin.bpr-ntb.co.id')->group(function () {

    // ❌ ROOT ADMIN TIDAK ADA APA-APA
    Route::get('/', function () {
        abort(404);
    });

    // 🔑 DOMAIN GATE (INPUT KODE DOMAIN)
    Route::get('/__x9k-admin-gate', function () {
        return view('admin.gate');
    });

    Route::post('/__x9k-admin-gate', [AuthController::class, 'verifyGate']);

    // 🔐 ROUTE LOGIN (TERKUNCI GATE)
    Route::middleware('admin.gate')->group(function () {

        Route::get('/login', [AuthController::class, 'showLogin']);
        Route::post('/login', [AuthController::class, 'login']);

        Route::middleware('auth:admin')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index']);
        });

    });
});
