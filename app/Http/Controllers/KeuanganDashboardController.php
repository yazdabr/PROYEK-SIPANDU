<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\ArsipVerifikasi;
use App\Models\ArsipPublik;
use App\Models\UnitPengolah;
use App\Models\Arsip;
use Illuminate\Support\Facades\Auth;

class KeuanganDashboardController extends Controller
{
    public function index()
    {
        // Pengecekan Akses Manual untuk UPKeuangan
        if (Auth::user()->email !== 'upkeuangan@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        // Total arsip publik khusus unit Keuangan
        $keuanganUnitId = UnitPengolah::where('nama_unit', 'TATA USAHA KEUANGAN')->value('id');
        
        // Menghitung total arsip berdasarkan unit Keuangan
        $totalArsipUnit = ArsipUnit::where('unit_pengolah_id', $keuanganUnitId)->count();
        $totalArsipPPID = ArsipPublik::where('unit_pengolah_id', $keuanganUnitId)->count();

        // Total arsip sudah verifikasi
        // Asumsi: ArsipPublik sudah melewati verifikasi.
        $totalSudahVerif = ArsipPublik::where('unit_pengolah_id', $keuanganUnitId)->count();

        // Total arsip belum verifikasi -> ambil langsung dari tabel arsip_verifikasi
        // Asumsi: ArsipVerifikasi adalah arsip yang menunggu verifikasi
        $totalBelumVerif = ArsipVerifikasi::where('unit_pengolah_id', $keuanganUnitId)->count();

        return view('upkeuangan.keuangandashboard', compact(
            'totalArsipUnit',
            'totalArsipPPID',
            'totalSudahVerif',
            'totalBelumVerif'
        ));
    }
}