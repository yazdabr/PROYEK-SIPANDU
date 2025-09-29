<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\ArsipVerifikasi;
use App\Models\ArsipPublik;
use App\Models\UnitPengolah;
use App\Models\Arsip;
use Illuminate\Support\Facades\Auth;


class TmbDashboardController extends Controller
{
public function index()
{
    // Total arsip unit
    $totalArsipUnit = ArsipUnit::count();

    // Total arsip publik khusus unit TMB
    $tmbUnitId = UnitPengolah::where('nama_unit', 'TMB')->value('id');
    $totalArsipPPID = ArsipPublik::where('unit_pengolah_id', $tmbUnitId)->count();
    $totalArsipUnit = ArsipUnit::where('unit_pengolah_id', $tmbUnitId)->count();

    // Total arsip sudah verifikasi
    $totalSudahVerif = ArsipPublik::where('unit_pengolah_id', $tmbUnitId)->count();

    // Total arsip belum verifikasi -> ambil langsung dari tabel arsip_verifikasi
    $totalBelumVerif = ArsipVerifikasi::where('unit_pengolah_id', $tmbUnitId)->count();
    
            // Pengecekan Akses Manual untuk UPTMB
        if (Auth::user()->email !== 'uptmb@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }

    return view('uptmb.tmbdashboard', compact(
        'totalArsipUnit',
        'totalArsipPPID',
        'totalSudahVerif',
        'totalBelumVerif'
    ));
}
}
