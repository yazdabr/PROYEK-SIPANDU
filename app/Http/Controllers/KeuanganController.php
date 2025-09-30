<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\KodeKlasifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    // --- CEK AKSES: Hanya untuk UPKEUANGAN ---
    private function checkAccess()
    {
        if (Auth::user()->email !== 'upkeuangan@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }
    }

    // --- INDEX: Daftar Arsip KEUANGAN ---
    public function index(Request $request)
    {
        $this->checkAccess();

        $query = ArsipUnit::with('unitPengolah', 'kodeKlasifikasi')
            ->whereHas('unitPengolah', function ($q) {
                $q->where('nama_unit', 'TATA USAHA KEUANGAN');
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

        // Dropdown judul khusus unit KEUANGAN
        $judulList = ArsipUnit::whereHas('unitPengolah', function ($q) {
            $q->where('nama_unit', 'TATA USAHA KEUANGAN');
        })
            ->select('judul')->distinct()->pluck('judul');

        return view('upkeuangan.keuangan', compact('arsip', 'judulList'));
    }

    // --- CREATE: Form Input ---
    public function create()
    {
        $this->checkAccess();

        $kodeKlasifikasi = KodeKlasifikasi::all();
        $unitKeuangan = DB::table('unit_pengolah')->where('nama_unit', 'TATA USAHA KEUANGAN')->first();

        return view('upkeuangan.keuanganinput', compact('kodeKlasifikasi', 'unitKeuangan'));
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

        return redirect()->route('keuangan.index')->with('success', 'Arsip berhasil disimpan!');
    }

    // --- DESTROY: Hapus Arsip ---
    public function destroy($id)
    {
        $this->checkAccess();

        $arsip = ArsipUnit::findOrFail($id);
        $arsip->delete();

        return redirect()->route('keuangan.index')->with('success', 'Data berhasil dihapus');
    }

    // --- EDIT: Form Edit ---
    public function edit($id)
    {
        $this->checkAccess();

        $keuangan = ArsipUnit::findOrFail($id);
        $kodeKlasifikasi = KodeKlasifikasi::all();

        $unitKeuangan = DB::table('unit_pengolah')->where('nama_unit', 'TATA USAHA KEUANGAN')->first();
        if (!$unitKeuangan) {
            abort(500, 'Unit TATA USAHA KEUANGAN tidak ditemukan di database.');
        }

        return view('upkeuangan.keuanganedit', compact('keuangan', 'kodeKlasifikasi', 'unitKeuangan'));
    }

    // --- UPDATE: Simpan Perubahan ---
    public function update(Request $request, $id)
    {
        $this->checkAccess();

        $keuangan = ArsipUnit::findOrFail($id);

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

        $keuangan->judul                = $validated['judul'];
        $keuangan->nomor_arsip          = $nomor;
        $keuangan->kode_klasifikasi_id  = (int) $validated['kode_klasifikasi'];
        $keuangan->kategori             = $kategori;
        $keuangan->kategori_berita      = $validated['kategori_berita'];
        $keuangan->indeks               = $validated['indeks'] ?? null;
        $keuangan->uraian_informasi     = $validated['uraian_informasi'] ?? null;
        $keuangan->tanggal              = $validated['tanggal'] ?? null;
        $keuangan->tingkat_perkembangan = $validated['tingkat_perkembangan'];
        $keuangan->jumlah               = $validated['jumlah'] ?? null;
        $keuangan->satuan               = $validated['satuan'] ?? null;
        $keuangan->unit_pengolah_id     = $validated['unit_pengolah_id'];
        $keuangan->ruangan              = $validated['ruangan'] ?? null;
        $keuangan->no_box               = $validated['no_box'] ?? null;
        $keuangan->no_filling           = $validated['no_filling'] ?? null;
        $keuangan->no_laci              = $validated['no_laci'] ?? null;
        $keuangan->no_folder            = $validated['no_folder'] ?? null;
        $keuangan->skkaad               = $validated['skkaad'] ?? null;
        $keuangan->keterangan           = $validated['keterangan'] ?? null;

        if ($request->hasFile('upload_dokumen')) {
            $keuangan->upload_dokumen = $request->file('upload_dokumen')->store('arsip', 'public');
        }

        $keuangan->save();

        return redirect()->route('keuangan.index')->with('success', 'Data berhasil diperbarui');
    }
}
