<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\TmbController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\ArsipPublikController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TmbDashboardController;
use App\Http\Controllers\PpidController;

// // Redirect root ke login
// Route::get('/', function () {
//     return view('login'); // arahkan ke route login
// });

// Login dan Logout
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); // kembali ke halaman login
})->name('logout');

// UPTMB
Route::get('/uptmb/tmbdashboard', function () {
    return view('uptmb.tmbdashboard');
});
Route::get('/uptmb/tmb', function () {
    return view('uptmb.tmb');
});
Route::get('/uptmb/tmbinput', function () {
    return view('uptmb.tmbinput');
});

Route::get('/uptmb/tmb', [App\Http\Controllers\ArsipController::class, 'index'])->name('arsipunit.index');
Route::get('/uptmb/tmb', [ArsipController::class, 'indexTmb'])->name('tmb.index');
Route::get('/uptmb/tmbinput', [TmbController::class, 'create'])->name('tmb.create');
Route::post('/uptmb/tmbinput', [TmbController::class, 'store'])->name('tmb.store');
Route::resource('uptmb/tmb', TmbController::class);
Route::get('/uptmb/tmbdashboard', [TmbDashboardController::class, 'index'])
    ->name('uptmb.dashboard');



// PPID
Route::get('/ppid/ppidstatis', function () {
    return view('ppid.ppidstatis');
});
Route::get('/ppid/verifikasi', function () {
    return view('ppid.verifikasi');
});
Route::get('/ppid/dap', function () {
    return view('ppid.dap');
});
Route::get('/ppid/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
Route::delete('ppid/verifikasi/tidak/{id}', [VerifikasiController::class, 'tidak'])->name('verifikasi.tidak');
Route::post('ppid/verifikasi/publik/{id}', [VerifikasiController::class, 'publik'])->name('verifikasi.publik');

Route::get('/ppid/dap', [ArsipPublikController::class, 'index'])->name('arsip.publik');
Route::delete('/ppid/dap/{id}', [ArsipPublikController::class, 'destroy'])->name('arsip.publik.hapus');
Route::get('/ppid/ppidstatis', [PpidController::class, 'ppidStatis'])->name('ppid.ppidstatis');




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

