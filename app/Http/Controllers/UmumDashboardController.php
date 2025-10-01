<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\ArsipVerifikasi;
use App\Models\ArsipPublik;
use App\Models\UnitPengolah;
use App\Models\Arsip;
use Illuminate\Support\Facades\Auth;

class UmumDashboardController extends Controller
{
    public function index()
    {
        // Total arsip unit
        $totalArsipUnit = ArsipUnit::count();

        // Total arsip publik khusus unit TATA USAHA UMUM
        $umumUnitId = UnitPengolah::where('nama_unit', 'TATA USAHA UMUM')->value('id');
        $totalArsipPPID = ArsipPublik::where('unit_pengolah_id', $umumUnitId)->count();
        $totalArsipUnit = ArsipUnit::where('unit_pengolah_id', $umumUnitId)->count();

        // Total arsip sudah verifikasi
        $totalSudahVerif = ArsipPublik::where('unit_pengolah_id', $umumUnitId)->count();

        // Total arsip belum verifikasi -> ambil langsung dari tabel arsip_verifikasi
        $totalBelumVerif = ArsipVerifikasi::where('unit_pengolah_id', $umumUnitId)->count();
        
        // Pengecekan Akses Manual untuk UPUMUM
        if (Auth::user()->email !== 'upumum@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        return view('upumum.umumdashboard', compact(
            'totalArsipUnit',
            'totalArsipPPID',
            'totalSudahVerif',
            'totalBelumVerif'
        ));
    }
}
