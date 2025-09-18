<?php

namespace App\Http\Controllers;

use App\Models\Arsipunit;
use App\Models\KodeKlasifikasi;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index()
    {
        // ambil semua data arsipunit terbaru
        $arsipunit = Arsipunit::latest()->get();

        // kirim ke view up/dau.blade.php
        return view('up.dau', compact('arsipunit'));
    }

    public function create()
    {
        // ambil semua kode klasifikasi
        $kodeklasifikasi = KodeKlasifikasi::orderBy('kode')->get();

        return view('up.input', compact('kodeklasifikasi'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul'                  => 'required',
            'nomor'                  => 'required',
            'kategori'               => 'required',
            'kode_klasifikasi'       => 'required',
            'tingkat_perkembangan'   => 'required',
            'unit_pengolah_arsip'    => 'required',
        ], [
            'judul.required'                  => 'Judul wajib diisi',
            'nomor.required'                  => 'Nomor wajib diisi',
            'kategori.required'               => 'Kategori wajib diisi',
            'kode_klasifikasi.required'       => 'Kode Klasifikasi wajib diisi',
            'tingkat_perkembangan.required'   => 'Tingkat Perkembangan wajib diisi',
            'unit_pengolah_arsip.required'    => 'Unit Pengolah Arsip wajib diisi',
        ]);

        // Generate kode_final
        $last = Arsipunit::where('kode_klasifikasi', $request->kode_klasifikasi)
            ->orderBy('id', 'desc')
            ->first();

        if ($last) {
            $parts = explode('.', $last->kode_final);
            if (count($parts) == 2) {
                $newCode = $parts[0] . '.' . $parts[1] . '.01';
            } else {
                $lastNumber = intval($parts[2]);
                $newCode = $parts[0] . '.' . $parts[1] . '.' . str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
            }
        } else {
            $newCode = $request->kode_klasifikasi . '.01';
        }

        // Simpan data lengkap ke database
        $arsip = new Arsipunit();
        $arsip->judul               = $request->judul;
        $arsip->nomor               = $request->nomor;
        $arsip->kategori            = $request->kategori;
        $arsip->kode_klasifikasi    = $request->kode_klasifikasi;
        $arsip->kode_final          = $newCode;
        $arsip->indeks              = $request->indeks ?? null;
        $arsip->uraian_informasi    = $request->uraian_informasi ?? null;
        $arsip->tanggal             = $request->tanggal ?? null;
        $arsip->tingkat_perkembangan = $request->tingkat_perkembangan;
        $arsip->jumlah              = $request->jumlah ?? null;
        $arsip->satuan              = $request->satuan ?? null;
        $arsip->unit_pengolah_arsip = $request->unit_pengolah_arsip;
        $arsip->ruangan             = $request->ruangan ?? null;
        $arsip->no_filling          = $request->no_filling ?? null;
        $arsip->no_laci             = $request->no_laci ?? null;
        $arsip->no_folder           = $request->no_folder ?? null;
        $arsip->keterangan          = $request->keterangan ?? null;

        // upload dokumen jika ada
        if ($request->hasFile('upload_dokumen')) {
            $arsip->upload_dokumen = $request->file('upload_dokumen')->store('arsip', 'public');
        }

        $arsip->save();

        return redirect()->route('arsip.index')->with('success', 'Data arsip berhasil disimpan!');
    }

    public function destroy($id)
    {
        $arsip = Arsipunit::findOrFail($id);
        $arsip->delete();

        return redirect()->route('arsip.index')->with('success', 'Data berhasil dihapus!');
    }
}
