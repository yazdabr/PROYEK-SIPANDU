<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\ArsipPublik;
use Illuminate\Support\Facades\Auth;

class ManajemenController extends Controller
{
    /**
     * Memastikan user yang sedang login adalah Manajemen.
     */
    private function checkAuthorization()
    {
        if (Auth::user()->email !== 'manajemen@gmail.com') {
            // Menggunakan abort(403) untuk menghentikan request jika tidak diizinkan
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman Manajemen.');
        }
    }

    // Halaman Dashboard Manajemen
    public function dashboard()
    {
        $this->checkAuthorization(); // Pengecekan Otorisasi

        $totalArsipUnit = ArsipUnit::count();
        $totalArsipPPID = ArsipPublik::count();

        return view('manajemen.mastatis', compact('totalArsipUnit', 'totalArsipPPID'));
    }

    // Laporan Arsip Unit
    public function laporanArsip(Request $request)
    {
        $this->checkAuthorization(); // Pengecekan Otorisasi

        $query = ArsipUnit::with(['kodeKlasifikasi', 'unitPengolah']);

        if ($request->filled('judul')) {
            $query->where('judul', $request->judul);
        }
            // Filter berdasarkan unit pengolah
        if ($request->filled('unit_pengolah_id')) {
            $query->where('unit_pengolah_id', $request->unit_pengolah_id);
        }


        $arsipUnit = $query->latest()->get();
        $judulUnitList = ArsipUnit::pluck('judul')->unique()->values();
        $totalArsipUnit = ArsipUnit::count();
        $unitList      = \App\Models\UnitPengolah::pluck('nama_unit', 'id');

    return view('manajemen.laporanarsip', compact('arsipUnit', 'judulUnitList', 'unitList'));
    }

    // Laporan Arsip Publik
    public function laporanLayanan(Request $request)
    {
        $this->checkAuthorization(); // Pengecekan Otorisasi

        $query = ArsipPublik::with(['kodeKlasifikasi', 'unitPengolah']);

        if ($request->filled('judul')) {
            $query->where('judul', $request->judul);
        }

            // Filter berdasarkan unit pengolah
        if ($request->filled('unit_pengolah_id')) {
            $query->where('unit_pengolah_id', $request->unit_pengolah_id);
        }


        $arsipPublik = $query->latest()->get();
        $judulList = ArsipPublik::pluck('judul')->unique()->values();
        $unitList  = \App\Models\UnitPengolah::pluck('nama_unit', 'id');

        return view('manajemen.laporanlayanan', compact('arsipPublik', 'judulList', 'unitList'));
    }
}
