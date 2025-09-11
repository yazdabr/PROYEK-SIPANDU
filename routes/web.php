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
