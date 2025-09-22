<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\ArsipPublik;

class VerifikasiController extends Controller
{

    public function index()
    {
        // Ambil data arsip yang belum diverifikasi
        $arsip = ArsipUnit::whereNull('status_verifikasi')->get();

        // Kirim ke view
        return view('ppid.verifikasi', compact('arsip'));
    }

public function publik($id)
{
    $arsip = ArsipUnit::with(['unitPengolah', 'kodeKlasifikasi'])->findOrFail($id);

    ArsipPublik::create([
        'judul'              => $arsip->judul,
        'nomor_arsip'        => $arsip->nomor_arsip,
        'kategori'           => $arsip->kategori,
        'kode_klasifikasi_id'=> $arsip->kode_klasifikasi_id,
        'indeks'             => $arsip->indeks,
        'uraian_informasi'   => $arsip->uraian_informasi,
        'tanggal'            => $arsip->tanggal,
        'tingkat_perkembangan'=> $arsip->tingkat_perkembangan,
        'jumlah'             => $arsip->jumlah,
        'satuan'             => $arsip->satuan,
        'unit_pengolah_id'   => $arsip->unit_pengolah_id,
        'ruangan'            => $arsip->ruangan,
        'no_filling'         => $arsip->no_filling,
        'no_laci'            => $arsip->no_laci,
        'no_folder'          => $arsip->no_folder,
        'keterangan'         => $arsip->keterangan,
        'skkaad'             => $arsip->skkaad,
        'upload_dokumen'     => $arsip->upload_dokumen,
    ]);

    // Update status agar tidak tampil lagi di verifikasi
    $arsip->update(['status_verifikasi' => 'publik']);

    return redirect()->back()->with('success', 'Arsip berhasil dipindahkan ke arsip publik.');
}


    public function tolak($id)
    {
        $arsip = ArsipUnit::findOrFail($id);

        // Tandai sebagai ditolak, jadi hilang dari view verifikasi
        $arsip->update(['status_verifikasi' => 'ditolak']); 

        return back()->with('info', 'Arsip ditolak.');
    }
}
