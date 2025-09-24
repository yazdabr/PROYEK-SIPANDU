<?php

namespace App\Http\Controllers;

use App\Models\ArsipUnit;
use App\Models\Arsip;
use Illuminate\Http\Request;
use App\Models\ArsipVerifikasi;
use App\Models\ArsipPublik;


class VerifikasiController extends Controller
{
    // Menampilkan arsip dari arsip_unit yang kategori PPID
    public function index()
    {
        $arsip = \App\Models\ArsipVerifikasi::with(['unitPengolah', 'kodeKlasifikasi'])
            ->orderBy('created_at', 'desc')->get();

        // panggil view ppid/verifikasi
        return view('ppid.verifikasi', compact('arsip'));
    }
        // Tombol YA
    public function publik($id)
    {
        $item = ArsipVerifikasi::findOrFail($id);

        // Copy ke arsip_publik
        ArsipPublik::create([
            'judul' => $item->judul,
            'nomor_arsip' => $item->nomor_arsip,
            'kode_klasifikasi_id' => $item->kode_klasifikasi_id,
            'kategori' => $item->kategori,
            'kategori_berita' => $item->kategori_berita,
            'status_verifikasi' => 'publik',
            'indeks' => $item->indeks,
            'uraian_informasi' => $item->uraian_informasi,
            'tanggal' => $item->tanggal,
            'tingkat_perkembangan' => $item->tingkat_perkembangan,
            'jumlah' => $item->jumlah,
            'satuan' => $item->satuan,
            'unit_pengolah_id' => $item->unit_pengolah_id,
            'ruangan' => $item->ruangan,
            'no_box' => $item->no_box,
            'no_filling' => $item->no_filling,
            'no_laci' => $item->no_laci,
            'no_folder' => $item->no_folder,
            'keterangan' => $item->keterangan,
            'skkaad' => $item->skkaad,
            'upload_dokumen' => $item->upload_dokumen,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at
        ]);

        // Hapus dari arsip_verifikasi
        $item->delete();
        return redirect('ppid/dap')->with('success', 'Data berhasil dipublikasikan.');

    }

    // Tombol TIDAK
    public function tidak($id)
    {
        $item = ArsipVerifikasi::findOrFail($id);

        // Hapus saja
        $item->delete();

        return redirect()->back()->with('warning', 'Data tidak dipublikasikan.');
    }

}
