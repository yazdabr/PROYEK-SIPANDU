<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\TmbController;
use App\Http\Controllers\VerifikasiController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login'); // arahkan ke route login
});


// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// TMB
Route::middleware(['auth', 'role:TMB'])->prefix('uptmb')->group(function () {
    Route::view('/tmb', 'uptmb.tmb')->name('uptmb.tmb');
    Route::view('/tmbinput', 'uptmb.tmbinput')->name('uptmb.input');
    Route::view('/tmbdashboard', 'uptmb.tmbdashboard')->name('uptmb.dashboard');
});

// UPTMB
Route::get('/tmb', function () {
    return view('uptmb.tmb');
});
Route::get('/tmbinput', function () {
    return view('uptmb.tmbinput');
});
Route::get('/tmbdashboard', function () {
    return view('uptmb.tmbdashboard');
});
Route::get('/tmb', [App\Http\Controllers\ArsipController::class, 'index'])->name('arsipunit.index');
Route::delete('/arsipunit/{id}', [App\Http\Controllers\ArsipController::class, 'destroy'])->name('arsipunit.destroy');
Route::get('/tmb', [ArsipController::class, 'indexTmb'])->name('tmb.index');
Route::get('/tmbinput', [TmbController::class, 'create'])->name('tmb.create');
Route::post('/tmbinput', [TmbController::class, 'store'])->name('tmb.store');
Route::resource('tmb', TmbController::class);



// PPID
Route::get('/ppidstatis', function () {
    return view('ppid.ppidstatis');
});
Route::get('/verifikasi', function () {
    return view('ppid.verifikasi');
});
Route::get('/dap', function () {
    return view('ppid.dap');
});
Route::get('/verifikasi', [App\Http\Controllers\VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::post('/verifikasi/publik/{id}', [VerifikasiController::class, 'publik'])->name('verifikasi.publik');
Route::delete('/verifikasi/{id}/tolak', [VerifikasiController::class, 'tolak'])->name('verifikasi.tolak');


// Manajemen
Route::get('/mastatis', function () {
    return view('manajemen.mastatis');
});
Route::get('/laporanarsip', function () {
    return view('manajemen.laporanarsip');
});
Route::get('/laporanlayanan', function () {
    return view('manajemen.laporanlayanan');
});

