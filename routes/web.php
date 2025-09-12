<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/upstatis', function () {
    return view('up.upstatis');
});
Route::get('/ppidstatis', function () {
    return view('ppid.ppidstatis');
});
Route::get('/mastatis', function () {
    return view('manajemen.mastatis');
});
Route::get('/input', function () {
    return view('up.input');
});
Route::get('/dau', function () {
    return view('up.dau');
});
