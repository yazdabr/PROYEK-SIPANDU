<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;

class VerifikasiController extends Controller
{
    public function index()
    {
        // Ambil data arsip_unit kategori PPID
        $arsip = ArsipUnit::where('kategori', 'PPID')->get();

        return view('ppid.verifikasi', compact('arsip'));
    }
}
