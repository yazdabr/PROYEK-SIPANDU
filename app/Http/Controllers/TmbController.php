<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\KodeKlasifikasi;

class TmbController extends Controller
{
public function index(Request $request)
{
    // query arsip khusus unit TMB
    $query = ArsipUnit::with('unitPengolah', 'kodeKlasifikasi')
        ->whereHas('unitPengolah', function($q){
            $q->where('nama_unit', 'TMB');
        });

    // Filter berdasarkan judul
    if ($request->filled('judul')) {
        $query->where('judul', $request->judul);
    }

    // Filter berdasarkan indeks
    if ($request->filled('indeks')) {
        $query->where('indeks', 'like', '%'.$request->indeks.'%');
    }

    // Filter berdasarkan uraian informasi
    if ($request->filled('uraian_informasi')) {
        $query->where('uraian_informasi', 'like', '%'.$request->uraian_informasi.'%');
    }

    // ambil data hasil filter
    $arsip = $query->orderBy('created_at','desc')->paginate(10);

    // ambil daftar judul unik untuk dropdown
    $judulList = ArsipUnit::select('judul')->distinct()->pluck('judul');

    return view('uptmb.tmb', compact('arsip','judulList'));
    
}

    public function create()
    {
        // ambil semua kode klasifikasi buat dropdown
        $kodeKlasifikasi = KodeKlasifikasi::all();

        // ambil id unit pengolah TMB
        $unitTmb = \DB::table('unit_pengolah')->where('nama_unit', 'TMB')->first();

        return view('uptmb.tmbinput', compact('kodeKlasifikasi','unitTmb'));
    }

    public function store(Request $request)
    {
        // validasi (gunakan nama input yang memang dikirim oleh form)
        $validated = $request->validate([
            'judul'                 => 'required|string|max:255',
            // terima kedua nama agar fleksibel
            'nomor_arsip'           => 'nullable|string|max:255',
            'nomor'                 => 'nullable|string|max:255',
            'kode_klasifikasi'      => 'required|integer', // harus id dari tabel kode_klasifikasi
            'kategori'              => 'required|string',
            'kategori_berita'       => 'required|string',
            'indeks'                => 'nullable|string',
            'uraian_informasi'      => 'nullable|string',
            'tanggal'               => 'nullable|date',
            'tingkat_perkembangan'  => 'required|string',
            'jumlah'                => 'nullable|integer',
            'satuan'                => 'nullable|string',
            'unit_pengolah_id'      => 'required|integer',
            'ruangan'               => 'nullable|string',
            'no_box'                => 'nullable|string',
            'no_filling'            => 'nullable|string',
            'no_laci'               => 'nullable|string',
            'no_folder'             => 'nullable|string',
            'skkaad'                => 'nullable|string',
            'keterangan'            => 'nullable|string',
            'upload_dokumen'        => 'nullable|file|max:10240', // 10MB, atur sesuai kebutuhan
        ]);

        // ambil nomor dengan fallback: nomor_arsip -> nomor -> null
        $nomor = $request->input('nomor_arsip', $request->input('nomor', null));

        $arsip = new ArsipUnit();
        $arsip->judul                = $validated['judul'];
        $arsip->nomor_arsip          = $nomor;
        $arsip->kode_klasifikasi_id  = (int) $validated['kode_klasifikasi'];
        $arsip->kategori             = $validated['kategori'];
        $arsip->kategori_berita      = $validated['kategori_berita'];
        $arsip->indeks               = $validated['indeks'] ?? null;
        $arsip->uraian_informasi     = $validated['uraian_informasi'] ?? null;
        $arsip->tanggal              = $validated['tanggal'] ?? null;
        $arsip->tingkat_perkembangan = $validated['tingkat_perkembangan'];
        $arsip->jumlah               = $validated['jumlah'] ?? null;
        $arsip->satuan               = $validated['satuan'] ?? null;
        $arsip->unit_pengolah_id     = $validated['unit_pengolah_id'];
        $arsip->ruangan              = $validated['ruangan'] ?? null;
        $arsip->no_box               = $validated['no_box'] ?? null;
        $arsip->no_filling           = $validated['no_filling'] ?? null;
        $arsip->no_laci              = $validated['no_laci'] ?? null;
        $arsip->no_folder            = $validated['no_folder'] ?? null;
        $arsip->skkaad               = $validated['skkaad'] ?? null;
        $arsip->keterangan           = $validated['keterangan'] ?? null;

        if ($request->hasFile('upload_dokumen')) {
            $arsip->upload_dokumen = $request->file('upload_dokumen')->store('arsip', 'public');
        }

        $arsip->save();

        return redirect()->route('tmb.index')->with('success', 'Arsip berhasil disimpan!');
    }

    public function destroy($id)
    {
        $arsip = ArsipUnit::findOrFail($id);
        $arsip->delete();

        return redirect()->route('tmb.index')->with('success', 'Data berhasil dihapus');
    }
}
