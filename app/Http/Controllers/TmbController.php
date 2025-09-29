<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipUnit;
use App\Models\KodeKlasifikasi;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import
use Illuminate\Support\Facades\DB;   // Untuk penggunaan DB::table

class TmbController extends Controller
{
    // --- FUNSI PEMBANTU UNTUK CEK AKSES ---
    // Fungsi ini akan dipanggil di awal setiap method
    private function checkAccess()
    {
        // Pengecekan Akses Manual untuk UPTMB
            if (Auth::user()->email !== 'uptmb@gmail.com') {
                abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
            }
    }
    
    // --- 1. INDEX (Menampilkan Daftar Arsip TMB) ---
    public function index(Request $request)
    {
        $this->checkAccess(); // Panggil fungsi cek akses di awal

        // query arsip khusus unit TMB
        $query = ArsipUnit::with('unitPengolah', 'kodeKlasifikasi')
            ->whereHas('unitPengolah', function($q){
                $q->where('nama_unit', 'TMB');
            });

        // Filter berdasarkan judul
        if ($request->filled('judul')) {
            // Ubah menjadi like jika judul tidak perlu sama persis
            $query->where('judul', 'like', '%'.$request->judul.'%'); 
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
        // Sebaiknya filter juga berdasarkan unit TMB agar dropdown relevan
        $judulList = ArsipUnit::select('judul')->distinct()->pluck('judul');
        $judulList = ArsipUnit::whereHas('unitPengolah', function($q){
                                $q->where('nama_unit', 'TMB');
                            })
                            ->select('judul')->distinct()->pluck('judul');
                            
        if (Auth::user()->email !== 'uptmb@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }
        
        // Catatan: Pengecekan akses yang lama sudah dihapus dari sini dan dipindahkan ke checkAccess()
        return view('uptmb.tmb', compact('arsip','judulList'));
    }

    // --- 2. CREATE (Menampilkan Form Input) ---
    public function create()
    {
        $this->checkAccess(); // Panggil fungsi cek akses di awal

        // ambil semua kode klasifikasi buat dropdown
        $kodeKlasifikasi = KodeKlasifikasi::all();

        // ambil id unit pengolah TMB
        $unitTmb = DB::table('unit_pengolah')->where('nama_unit', 'TMB')->first();

        return view('uptmb.tmbinput', compact('kodeKlasifikasi','unitTmb'));
    }

    // --- 3. STORE (Menyimpan Data Baru) ---
    public function store(Request $request)
    {
        $this->checkAccess(); // Panggil fungsi cek akses di awal
        
        // ... (Logika Validasi dan Penyimpanan Data sama seperti kode Anda) ...
        
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

        return redirect()->route('tmb.index')->with('success', 'Arsip berhasil disimpan!');
    }

    // --- 4. DESTROY (Menghapus Data) ---
    public function destroy($id)
    {
        $this->checkAccess(); // Panggil fungsi cek akses di awal

        $arsip = ArsipUnit::findOrFail($id);
        $arsip->delete();

        return redirect()->route('tmb.index')->with('success', 'Data berhasil dihapus');
    }

    // --- 5. EDIT (Menampilkan Form Edit) ---
    public function edit($id)
    {
        $this->checkAccess(); // Panggil fungsi cek akses di awal

        $tmb = ArsipUnit::findOrFail($id);
        $kodeKlasifikasi = KodeKlasifikasi::all();
        
        // Memastikan $unitTmb diambil dari DB atau disesuaikan dengan kebutuhan
        $unitTmb = DB::table('unit_pengolah')->where('nama_unit', 'TMB')->first();
        if (!$unitTmb) {
             // Handle jika unit TMB tidak ditemukan (optional)
             abort(500, 'Unit TMB tidak ditemukan di database.');
        }

        return view('uptmb.tmbedit', compact('tmb', 'kodeKlasifikasi', 'unitTmb'));
    }

    // --- 6. UPDATE (Memperbarui Data) ---
    public function update(Request $request, $id)
    {
        $this->checkAccess(); // Panggil fungsi cek akses di awal

        // ... (Logika Validasi dan Update Data sama seperti kode Anda) ...
        
        $tmb = ArsipUnit::findOrFail($id);

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

        $tmb->judul                = $validated['judul'];
        $tmb->nomor_arsip          = $nomor;
        $tmb->kode_klasifikasi_id  = (int) $validated['kode_klasifikasi'];
        $tmb->kategori             = $kategori;
        $tmb->kategori_berita      = $validated['kategori_berita'];
        $tmb->indeks               = $validated['indeks'] ?? null;
        $tmb->uraian_informasi     = $validated['uraian_informasi'] ?? null;
        $tmb->tanggal              = $validated['tanggal'] ?? null;
        $tmb->tingkat_perkembangan = $validated['tingkat_perkembangan'];
        $tmb->jumlah               = $validated['jumlah'] ?? null;
        $tmb->satuan               = $validated['satuan'] ?? null;
        $tmb->unit_pengolah_id     = $validated['unit_pengolah_id'];
        $tmb->ruangan              = $validated['ruangan'] ?? null;
        $tmb->no_box               = $validated['no_box'] ?? null;
        $tmb->no_filling           = $validated['no_filling'] ?? null;
        $tmb->no_laci              = $validated['no_laci'] ?? null;
        $tmb->no_folder            = $validated['no_folder'] ?? null;
        $tmb->skkaad               = $validated['skkaad'] ?? null;
        $tmb->keterangan           = $validated['keterangan'] ?? null;

        if ($request->hasFile('upload_dokumen')) {
            $tmb->upload_dokumen = $request->file('upload_dokumen')->store('arsip', 'public');
        }

        $tmb->save();

        return redirect()->route('tmb.index')->with('success', 'Data berhasil diperbarui');
    }
}