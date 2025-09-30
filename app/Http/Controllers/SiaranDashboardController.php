<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\ArsipVerifikasi;
use App\Models\ArsipPublik;
use App\Models\UnitPengolah;
use App\Models\Arsip;
use Illuminate\Support\Facades\Auth;

class SiaranDashboardController extends Controller
{
    public function index()
    {
        // Total arsip unit
        $totalArsipUnit = ArsipUnit::count();

        // Total arsip publik khusus unit Siaran
        $siaranUnitId = UnitPengolah::where('nama_unit', 'Siaran')->value('id');
        $totalArsipPPID = ArsipPublik::where('unit_pengolah_id', $siaranUnitId)->count();
        $totalArsipUnit = ArsipUnit::where('unit_pengolah_id', $siaranUnitId)->count();

        // Total arsip sudah verifikasi
        $totalSudahVerif = ArsipPublik::where('unit_pengolah_id', $siaranUnitId)->count();

        // Total arsip belum verifikasi -> ambil langsung dari tabel arsip_verifikasi
        $totalBelumVerif = ArsipVerifikasi::where('unit_pengolah_id', $siaranUnitId)->count();
        
        // Pengecekan Akses Manual untuk UPSiaran
        if (Auth::user()->email !== 'upsiaran@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        return view('upsiaran.siarandashboard', compact(
            'totalArsipUnit',
            'totalArsipPPID',
            'totalSudahVerif',
            'totalBelumVerif'
        ));
    }
}
