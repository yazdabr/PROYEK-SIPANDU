<?php

use Illuminate\Support\Facades\Route;

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

