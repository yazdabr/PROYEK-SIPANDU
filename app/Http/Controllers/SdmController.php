<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\KodeKlasifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SdmController extends Controller
{
    // --- CEK AKSES: Hanya untuk UPSDM ---
    private function checkAccess()
    {
        if (Auth::user()->email !== 'upsdm@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }
    }

    // --- INDEX: Daftar Arsip SDM ---
    public function index(Request $request)
    {
        $this->checkAccess();

        $query = ArsipUnit::with('unitPengolah', 'kodeKlasifikasi')
            ->whereHas('unitPengolah', function ($q) {
                $q->where('nama_unit', 'TATA USAHA SDM');
            });

        if ($request->filled('judul')) {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        }

        if ($request->filled('indeks')) {
            $query->where('indeks', 'like', '%' . $request->indeks . '%');
        }

        if ($request->filled('uraian_informasi')) {
            $query->where('uraian_informasi', 'like', '%' . $request->uraian_informasi . '%');
        }

        $arsip = $query->orderBy('created_at', 'desc')->paginate(10);

        // Dropdown judul khusus unit SDM
        $judulList = ArsipUnit::whereHas('unitPengolah', function ($q) {
            $q->where('nama_unit', 'TATA USAHA SDM');
        })
            ->select('judul')->distinct()->pluck('judul');

        return view('upsdm.sdm', compact('arsip', 'judulList'));
    }

    // --- CREATE: Form Input ---
    public function create()
    {
        $this->checkAccess();

        $kodeKlasifikasi = KodeKlasifikasi::all();
        $unitSdm = DB::table('unit_pengolah')->where('nama_unit', 'TATA USAHA SDM')->first();

        return view('upsdm.sdminput', compact('kodeKlasifikasi', 'unitSdm'));
    }

    // --- STORE: Simpan Arsip ---
    public function store(Request $request)
    {
        $this->checkAccess();

        $validated = $request->validate([
            'judul'                  => 'required|string|max:255',
            'nomor_arsip'            => 'nullable|string|max:255',
            'nomor'                  => 'nullable|string|max:255',
            'kode_klasifikasi'       => 'required|integer',
            'kategori_berita'        => 'required|string',
            'indeks'                 => 'nullable|string',
            'uraian_informasi'       => 'nullable|string',
            'tanggal'                => 'nullable|date',
            'tingkat_perkembangan'   => 'required|string',
            'jumlah'                 => 'nullable|integer',
            'satuan'                 => 'nullable|string',
            'unit_pengolah_id'       => 'required|integer',
            'ruangan'                => 'nullable|string',
            'no_box'                 => 'nullable|string',
            'no_filling'             => 'nullable|string',
            'no_laci'                => 'nullable|string',
            'no_folder'              => 'nullable|string',
            'skkaad'                 => 'nullable|string',
            'keterangan'             => 'nullable|string',
            'upload_dokumen'         => 'nullable|file|max:10240',
        ]);

        $kategori = ($validated['kategori_berita'] === '-') ? '-' : 'PPID';
        $nomor = $request->input('nomor_arsip', $request->input('nomor', null));

        $arsip = new ArsipUnit();
        $arsip->judul                = $validated['judul'];
        $arsip->nomor_arsip          = $nomor;
        $arsip->kode_klasifikasi_id  = (int) $validated['kode_klasifikasi'];
        $arsip->kategori             = $kategori;
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

        return redirect()->route('sdm.index')->with('success', 'Arsip berhasil disimpan!');
    }

    // --- DESTROY: Hapus Arsip ---
    public function destroy($id)
    {
        $this->checkAccess();

        $arsip = ArsipUnit::findOrFail($id);
        $arsip->delete();

        return redirect()->route('sdm.index')->with('success', 'Data berhasil dihapus');
    }

    // --- EDIT: Form Edit ---
    public function edit($id)
    {
        $this->checkAccess();

        $sdm = ArsipUnit::findOrFail($id);
        $kodeKlasifikasi = KodeKlasifikasi::all();

        $unitSdm = DB::table('unit_pengolah')->where('nama_unit', 'TATA USAHA SDM')->first();
        if (!$unitSdm) {
            abort(500, 'Unit SDM tidak ditemukan di database.');
        }

        return view('upsdm.sdmedit', compact('sdm', 'kodeKlasifikasi', 'unitSdm'));
    }

    // --- UPDATE: Simpan Perubahan ---
    public function update(Request $request, $id)
    {
        $this->checkAccess();

        $sdm = ArsipUnit::findOrFail($id);

        $validated = $request->validate([
            'judul'                  => 'required|string|max:255',
            'nomor_arsip'            => 'nullable|string|max:255',
            'nomor'                  => 'nullable|string|max:255',
            'kode_klasifikasi'       => 'required|integer',
            'kategori_berita'        => 'required|string',
            'indeks'                 => 'nullable|string',
            'uraian_informasi'       => 'nullable|string',
            'tanggal'                => 'nullable|date',
            'tingkat_perkembangan'   => 'required|string',
            'jumlah'                 => 'nullable|integer',
            'satuan'                 => 'nullable|string',
            'unit_pengolah_id'       => 'required|integer',
            'ruangan'                => 'nullable|string',
            'no_box'                 => 'nullable|string',
            'no_filling'             => 'nullable|string',
            'no_laci'                => 'nullable|string',
            'no_folder'              => 'nullable|string',
            'skkaad'                 => 'nullable|string',
            'keterangan'             => 'nullable|string',
            'upload_dokumen'         => 'nullable|file|max:10240',
        ]);

        $kategori = ($validated['kategori_berita'] === '-') ? '-' : 'PPID';
        $nomor = $request->input('nomor_arsip', $request->input('nomor', null));

        $sdm->judul                = $validated['judul'];
        $sdm->nomor_arsip          = $nomor;
        $sdm->kode_klasifikasi_id  = (int) $validated['kode_klasifikasi'];
        $sdm->kategori             = $kategori;
        $sdm->kategori_berita      = $validated['kategori_berita'];
        $sdm->indeks               = $validated['indeks'] ?? null;
        $sdm->uraian_informasi     = $validated['uraian_informasi'] ?? null;
        $sdm->tanggal              = $validated['tanggal'] ?? null;
        $sdm->tingkat_perkembangan = $validated['tingkat_perkembangan'];
        $sdm->jumlah               = $validated['jumlah'] ?? null;
        $sdm->satuan               = $validated['satuan'] ?? null;
        $sdm->unit_pengolah_id     = $validated['unit_pengolah_id'];
        $sdm->ruangan              = $validated['ruangan'] ?? null;
        $sdm->no_box               = $validated['no_box'] ?? null;
        $sdm->no_filling           = $validated['no_filling'] ?? null;
        $sdm->no_laci              = $validated['no_laci'] ?? null;
        $sdm->no_folder            = $validated['no_folder'] ?? null;
        $sdm->skkaad               = $validated['skkaad'] ?? null;
        $sdm->keterangan           = $validated['keterangan'] ?? null;

        if ($request->hasFile('upload_dokumen')) {
            $sdm->upload_dokumen = $request->file('upload_dokumen')->store('arsip', 'public');
        }

        $sdm->save();

        return redirect()->route('sdm.index')->with('success', 'Data berhasil diperbarui');
    }
}
