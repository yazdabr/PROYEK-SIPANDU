<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\ArsipVerifikasi;
use App\Models\ArsipPublik;
use App\Models\UnitPengolah;
use App\Models\Arsip;
use Illuminate\Support\Facades\Auth;

class SdmDashboardController extends Controller
{
    public function index()
    {
        // Total arsip unit
        $totalArsipUnit = ArsipUnit::count();

        // Total arsip publik khusus unit TATA USAHA SDM
        $sdmUnitId = UnitPengolah::where('nama_unit', 'TATA USAHA SDM')->value('id');
        $totalArsipPPID = ArsipPublik::where('unit_pengolah_id', $sdmUnitId)->count();
        $totalArsipUnit = ArsipUnit::where('unit_pengolah_id', $sdmUnitId)->count();

        // Total arsip sudah verifikasi
        $totalSudahVerif = ArsipPublik::where('unit_pengolah_id', $sdmUnitId)->count();

        // Total arsip belum verifikasi -> ambil langsung dari tabel arsip_verifikasi
        $totalBelumVerif = ArsipVerifikasi::where('unit_pengolah_id', $sdmUnitId)->count();
        
        // Pengecekan Akses Manual untuk UPSDM
        if (Auth::user()->email !== 'upsdm@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        return view('upsdm.sdmdashboard', compact(
            'totalArsipUnit',
            'totalArsipPPID',
            'totalSudahVerif',
            'totalBelumVerif'
        ));
    }
}
