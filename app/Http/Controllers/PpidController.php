<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipPublik;
use App\Models\ArsipVerifikasi;
use Illuminate\Support\Facades\Auth;

class PpidController extends Controller
{
    public function ppidstatis()
    {
        // Total semua arsip verifikasi
        $totalPublik = ArsipPublik::count();

        // Total arsip sudah verifikasi (publik + tidak_publik)
        $totalSudahVerif = ArsipPublik::whereIn('status_verifikasi', ['publik', 'tidak_publik'])->count();

        // Total arsip belum verifikasi (pending)
        $totalBelumVerif = ArsipVerifikasi::count();

                if (Auth::user()->email !== 'ppid@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        return view('ppid.ppidstatis', compact(
            'totalPublik',
            'totalSudahVerif',
            'totalBelumVerif'
        ));
    }
}
