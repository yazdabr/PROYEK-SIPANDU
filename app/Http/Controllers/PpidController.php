<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipPublik;
use App\Models\ArsipVerifikasi;

class PpidController extends Controller
{
    public function ppidStatis()
    {
        // total semua data di arsip_publik
        $totalPublik = ArsipPublik::count();

        // total arsip di arsip_verifikasi (belum verif)
        // jika kamu memakai status_verifikasi NULL untuk menandai belum verif:
        $totalBelumVerif = ArsipVerifikasi::whereNull('status_verifikasi')->count();
        // jika arsip_verifikasi tidak pakai status_verifikasi, cukup count():
        // $totalBelumVerif = ArsipVerifikasi::count();

        // total arsip di arsip_publik yang punya status_verifikasi = 'publik'
        // (sesuaikan kolom kalau berbeda)
        $totalSudahVerif = ArsipPublik::where('status_verifikasi', 'publik')->count();

        return view('ppid.ppidstatis', compact('totalPublik', 'totalBelumVerif', 'totalSudahVerif'));
    }
}
