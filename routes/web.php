<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TmbDashboardController;
use App\Http\Controllers\TmbController;
use App\Http\Controllers\TmbEditController;
use App\Http\Controllers\PpidController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\ArsipPublikController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\KmbController;           
use App\Http\Controllers\KmbDashboardController; 
use App\Http\Controllers\SiaranController;           
use App\Http\Controllers\SiaranDashboardController; 
use App\Http\Controllers\LpuController;           
use App\Http\Controllers\LpuDashboardController; 
use App\Http\Controllers\KeuanganController;           
use App\Http\Controllers\KeuanganDashboardController; 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda.
| Rute-rute ini dimuat oleh RouteServiceProvider dalam grup yang
| berisi middleware "web".
|
*/

// --- 1. RUTE LOGIN dan LOGOUT (Tidak Perlu Middleware 'auth') ---

// Menampilkan form login (Root page)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');

// Memproses login
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- 2. GRUP RUTE YANG DILINDUNGI (Wajib Login) ---
// Semua rute di dalam grup ini hanya bisa diakses oleh user yang sudah terautentikasi.
// Pembatasan user antar role dilakukan di dalam Controller.

Route::middleware('auth')->group(function () {

    // 2.1. Rute UPTMB
    Route::prefix('uptmb')->group(function () {
        // Halaman yang diizinkan untuk uptmb@gmail.com:

        // 1. uptmb/tmbdashboard
        Route::get('/tmbdashboard', [TmbDashboardController::class, 'index'])->name('uptmb.dashboard');

        // 2. uptmb/tmb (Index Daftar)
        Route::get('/tmb', [TmbController::class, 'index'])->name('tmb.index');

        // 3. uptmb/tmbinput (Create & Store)
        Route::get('/tmbinput', [TmbController::class, 'create'])->name('tmb.create');
        Route::post('/tmbinput', [TmbController::class, 'store'])->name('tmb.store');

        // 4. uptmb/tmbedit (Edit & Update) - Menggunakan route binding
        Route::get('/tmb/{id}/edit', [TmbEditController::class, 'edit'])->name('tmbedit.edit');
        Route::put('/tmb/{id}', [TmbEditController::class, 'update'])->name('tmbedit.update');

        // Route DELETE TMB (contoh, jika ada)
        Route::delete('/tmb/{id}', [TmbController::class, 'destroy'])->name('tmb.destroy');
        Route::get('/uptmb/tmb', [App\Http\Controllers\ArsipController::class, 'index'])->name('arsipunit.index');

        Route::get('/uptmb/tmb', [ArsipController::class, 'indexTmb'])->name('tmb.index');

        Route::get('/uptmb/tmbinput', [TmbController::class, 'create'])->name('tmb.create');

        Route::post('/uptmb/tmbinput', [TmbController::class, 'store'])->name('tmb.store');
        Route::get('/uptmb/tmb', [TmbController::class, 'index'])->name('tmb.index'); 
    });

    // 2.2. Rute UPKMB ✅ (Baru Ditambahkan)
    Route::prefix('upkmb')->group(function () {
        Route::get('/kmbdashboard', [KmbDashboardController::class, 'index'])->name('upkmb.dashboard');
        Route::get('/kmb', [KmbController::class, 'index'])->name('kmb.index');
        Route::get('/kmbinput', [KmbController::class, 'create'])->name('kmb.create');
        Route::post('/kmbinput', [KmbController::class, 'store'])->name('kmb.store');
        Route::get('/kmb/{id}/edit', [KmbController::class, 'edit'])->name('kmbedit.edit');
        Route::put('/kmb/{id}', [KmbController::class, 'update'])->name('kmbedit.update');
        Route::delete('/kmb/{id}', [KmbController::class, 'destroy'])->name('kmb.destroy');
    });

    // 2.2. Rute UPSIARAN 
    Route::prefix('upsiaran')->group(function () {
        Route::get('/siarandashboard', [SiaranDashboardController::class, 'index'])->name('upsiaran.dashboard');
        Route::get('/siaran', [SiaranController::class, 'index'])->name('siaran.index');
        Route::get('/siaraninput', [SiaranController::class, 'create'])->name('siaran.create');
        Route::post('/siaraninput', [SiaranController::class, 'store'])->name('siaran.store');
        Route::get('/siaran/{id}/edit', [SiaranController::class, 'edit'])->name('siaranedit.edit');
        Route::put('/siaran/{id}', [SiaranController::class, 'update'])->name('siaranedit.update');
        Route::delete('/siaran/{id}', [SiaranController::class, 'destroy'])->name('siaran.destroy');
    });

    // 2.2. Rute UPLPU 
    Route::prefix('uplpu')->group(function () {
        Route::get('/lpudashboard', [LpuDashboardController::class, 'index'])->name('uplpu.dashboard');
        Route::get('/lpu', [LpuController::class, 'index'])->name('lpu.index');
        Route::get('/lpuinput', [LpuController::class, 'create'])->name('lpu.create');
        Route::post('/lpuinput', [LpuController::class, 'store'])->name('lpu.store');
        Route::get('/lpu/{id}/edit', [LpuController::class, 'edit'])->name('lpuedit.edit');
        Route::put('/lpu/{id}', [LpuController::class, 'update'])->name('lpuedit.update');
        Route::delete('/lpu/{id}', [LpuController::class, 'destroy'])->name('lpu.destroy');
    });

    // 2.2. Rute UPKeuangan 
    Route::prefix('upkeuangan')->group(function () {
        Route::get('/keuangandashboard', [KeuanganDashboardController::class, 'index'])->name('upkeuangan.dashboard');
        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::get('/keuanganinput', [KeuanganController::class, 'create'])->name('keuangan.create');
        Route::post('/keuanganinput', [KeuanganController::class, 'store'])->name('keuangan.store');
        Route::get('/keuangan/{id}/edit', [KeuanganController::class, 'edit'])->name('keuanganedit.edit');
        Route::put('/keuangan/{id}', [KeuanganController::class, 'update'])->name('keuanganedit.update');
        Route::delete('/keuangan/{id}', [KeuanganController::class, 'destroy'])->name('keuangan.destroy');
    });


    // 2.2. Rute PPID
    Route::prefix('ppid')->group(function () {
        // Halaman yang diizinkan untuk ppid@gmail.com:

        // 1. ppid/ppidstatis
        Route::get('/ppidstatis', [PpidController::class, 'ppidStatis'])->name('ppid.ppidstatis');

        // 2. ppid/verifikasi
        Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
        Route::delete('/verifikasi/tidak/{id}', [VerifikasiController::class, 'tidak'])->name('verifikasi.tidak');
        Route::post('/verifikasi/publik/{id}', [VerifikasiController::class, 'publik'])->name('verifikasi.publik');

        // 3. ppid/dap
        Route::get('/dap', [ArsipPublikController::class, 'index'])->name('arsip.publik');
        Route::delete('/dap/{id}', [ArsipPublikController::class, 'destroy'])->name('arsip.publik.hapus');

        });

    // 2.3. Rute Manajemen (Contoh)
    Route::prefix('manajemen')->group(function () {
        Route::get('/mastatis', [ManajemenController::class, 'dashboard'])->name('manajemen.dashboard');
        Route::get('/laporanarsip', [ManajemenController::class, 'laporanArsip'])->name('manajemen.laporanarsip');
        Route::get('/laporanlayanan', [ManajemenController::class, 'laporanLayanan'])->name('manajemen.laporanlayanan');




});
});