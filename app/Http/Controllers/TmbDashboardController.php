<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\ArsipVerifikasi;
use App\Models\ArsipPublik;
use App\Models\UnitPengolah;
use App\Models\Arsip;

class TmbDashboardController extends Controller
{
    public function index()
    {
        // Total arsip unit
        $totalArsipUnit = ArsipUnit::count();

        // Total arsip publik khusus unit TMB
        $tmbUnitId = UnitPengolah::where('nama_unit', 'TMB')->value('id');
        $totalArsipPPID = ArsipPublik::where('unit_pengolah_id', $tmbUnitId)->count();

        // Total arsip sudah verifikasi
        $totalSudahVerif = ArsipPublik::count();

        // Total arsip belum verifikasi
        $totalBelumVerif = ArsipVerifikasi::where('status_verifikasi', 'pending')->count();

        return view('uptmb.tmbdashboard', compact(
            'totalArsipUnit',
            'totalArsipPPID',
            'totalSudahVerif',
            'totalBelumVerif'
        ));
    }
}
