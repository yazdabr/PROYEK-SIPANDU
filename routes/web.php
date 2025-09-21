<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\TmbController;


Route::get('/', function () {
    return view('login');
});

// UP
Route::get('/upstatis', function () {
    return view('up.upstatis');
});
Route::get('/input', function () {
    return view('up.input');
});
Route::get('/dau', function () {
    return view('up.dau');
});
Route::get('/input', [ArsipController::class, 'create'])->name('arsip.create');
Route::post('/arsip/store', [ArsipController::class, 'store'])->name('arsip.store'); // jika pakai store
Route::get('/dau', [ArsipController::class, 'index'])->name('arsip.index');
Route::delete('/arsip/{id}', [ArsipController::class, 'destroy'])->name('arsip.destroy');

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

