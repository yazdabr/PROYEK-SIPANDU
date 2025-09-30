<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\KodeKlasifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KmbController extends Controller
{
    // --- CEK AKSES: Hanya untuk UPKMB ---
    private function checkAccess()
    {
        if (Auth::user()->email !== 'upkmb@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }
    }

    // --- INDEX: Daftar Arsip KMB ---
    public function index(Request $request)
    {
        $this->checkAccess();

        $query = ArsipUnit::with('unitPengolah', 'kodeKlasifikasi')
            ->whereHas('unitPengolah', function ($q) {
                $q->where('nama_unit', 'KMB');
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

        // Dropdown judul khusus unit KMB
        $judulList = ArsipUnit::whereHas('unitPengolah', function ($q) {
            $q->where('nama_unit', 'KMB');
        })
            ->select('judul')->distinct()->pluck('judul');

        return view('upkmb.kmb', compact('arsip', 'judulList'));
    }

    // --- CREATE: Form Input ---
    public function create()
    {
        $this->checkAccess();

        $kodeKlasifikasi = KodeKlasifikasi::all();
        $unitKmb = DB::table('unit_pengolah')->where('nama_unit', 'KMB')->first();

        return view('upkmb.kmbinput', compact('kodeKlasifikasi', 'unitKmb'));
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

        return redirect()->route('kmb.index')->with('success', 'Arsip berhasil disimpan!');
    }

    // --- DESTROY: Hapus Arsip ---
    public function destroy($id)
    {
        $this->checkAccess();

        $arsip = ArsipUnit::findOrFail($id);
        $arsip->delete();

        return redirect()->route('kmb.index')->with('success', 'Data berhasil dihapus');
    }

    // --- EDIT: Form Edit ---
    public function edit($id)
    {
        $this->checkAccess();

        $kmb = ArsipUnit::findOrFail($id);
        $kodeKlasifikasi = KodeKlasifikasi::all();

        $unitKmb = DB::table('unit_pengolah')->where('nama_unit', 'KMB')->first();
        if (!$unitKmb) {
            abort(500, 'Unit KMB tidak ditemukan di database.');
        }

        return view('upkmb.kmbedit', compact('kmb', 'kodeKlasifikasi', 'unitKmb'));
    }

    // --- UPDATE: Simpan Perubahan ---
    public function update(Request $request, $id)
    {
        $this->checkAccess();

        $kmb = ArsipUnit::findOrFail($id);

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

        $kmb->judul                = $validated['judul'];
        $kmb->nomor_arsip          = $nomor;
        $kmb->kode_klasifikasi_id  = (int) $validated['kode_klasifikasi'];
        $kmb->kategori             = $kategori;
        $kmb->kategori_berita      = $validated['kategori_berita'];
        $kmb->indeks               = $validated['indeks'] ?? null;
        $kmb->uraian_informasi     = $validated['uraian_informasi'] ?? null;
        $kmb->tanggal              = $validated['tanggal'] ?? null;
        $kmb->tingkat_perkembangan = $validated['tingkat_perkembangan'];
        $kmb->jumlah               = $validated['jumlah'] ?? null;
        $kmb->satuan               = $validated['satuan'] ?? null;
        $kmb->unit_pengolah_id     = $validated['unit_pengolah_id'];
        $kmb->ruangan              = $validated['ruangan'] ?? null;
        $kmb->no_box               = $validated['no_box'] ?? null;
        $kmb->no_filling           = $validated['no_filling'] ?? null;
        $kmb->no_laci              = $validated['no_laci'] ?? null;
        $kmb->no_folder            = $validated['no_folder'] ?? null;
        $kmb->skkaad               = $validated['skkaad'] ?? null;
        $kmb->keterangan           = $validated['keterangan'] ?? null;

        if ($request->hasFile('upload_dokumen')) {
            $kmb->upload_dokumen = $request->file('upload_dokumen')->store('arsip', 'public');
        }

        $kmb->save();

        return redirect()->route('kmb.index')->with('success', 'Data berhasil diperbarui');
    }
}
