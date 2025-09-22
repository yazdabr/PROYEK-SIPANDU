<?php

namespace App\Http\Controllers;

use App\Models\KodeKlasifikasi;
use App\Models\ArsipUnit;
use App\Models\ArsipVerifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArsipController extends Controller
{
    public function index()
    {
        $arsip = ArsipUnit::with('kodeKlasifikasi')->get();
        return view('uptmb.tmb', compact('arsip'));
    }

    public function indexTmb()
    {
        $arsip = DB::table('arsip_unit')
            ->join('unit_pengolah', 'arsip_unit.unit_pengolah_id', '=', 'unit_pengolah.id')
            ->leftJoin('kode_klasifikasi', 'arsip_unit.kode_klasifikasi_id', '=', 'kode_klasifikasi.id')
            ->where('unit_pengolah.nama_unit', 'TMB')
            ->select(
                'arsip_unit.*',
                'unit_pengolah.nama_unit as unit_pengolah_arsip',
                'kode_klasifikasi.kode as kode_klasifikasi_kode'
            )
            ->orderBy('arsip_unit.created_at', 'desc')
            ->get();

        return view('uptmb.tmb', compact('arsip'));
    }

    public function create()
    {
        $kodeklasifikasi = KodeKlasifikasi::orderBy('kode')->get();
        return view('up.input', compact('kodeklasifikasi'));
    }

public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'judul'                 => 'required',
        'nomor_arsip'           => 'required',
        'kategori'              => 'required',
        'kode_klasifikasi_id'   => 'required',
        'tingkat_perkembangan'  => 'required',
        'unit_pengolah_id'      => 'required',
    ]);

    // Generate kode_final
    $last = ArsipUnit::where('kode_klasifikasi_id', $request->kode_klasifikasi_id)
        ->orderBy('id', 'desc')
        ->first();

    if ($last && $last->kode_final) {
        $parts = explode('.', $last->kode_final);
        if (count($parts) == 2) {
            $newCode = $parts[0] . '.' . $parts[1] . '.01';
        } else {
            $lastNumber = intval(end($parts));
            $parts[count($parts) - 1] = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
            $newCode = implode('.', $parts);
        }
    } else {
        $newCode = $request->kode_klasifikasi_id . '.01';
    }

// Simpan ke arsip_unit
$arsip = ArsipUnit::create([
    'judul'                 => $request->judul,
    'nomor_arsip'           => $request->nomor_arsip,
    'kategori'              => $request->kategori,
    'kode_klasifikasi_id'   => $request->kode_klasifikasi_id,
    'kode_final'            => $newCode,
    'indeks'                => $request->indeks ?? null,
    'uraian_informasi'      => $request->uraian_informasi ?? null,
    'tanggal'               => $request->tanggal ?? null,
    'tingkat_perkembangan'  => $request->tingkat_perkembangan,
    'jumlah'                => $request->jumlah ?? null,
    'satuan'                => $request->satuan ?? null,
    'unit_pengolah_id'      => $request->unit_pengolah_id,
    'ruangan'               => $request->ruangan ?? null,
    'no_box'                => $request->no_box ?? null,
    'no_filling'            => $request->no_filling ?? null,
    'no_laci'               => $request->no_laci ?? null,
    'no_folder'             => $request->no_folder ?? null,
    'keterangan'            => $request->keterangan ?? null,
    'skkaad'                => $request->skkaad ?? null,
    'upload_dokumen'        => $request->hasFile('upload_dokumen') 
                               ? $request->file('upload_dokumen')->store('arsip', 'public')
                               : null,
]);

dd($arsip->kategori);

// Copy ke arsip_verifikasi jika PPID
if (strtoupper(trim($arsip->kategori)) === 'PPID') {
    ArsipVerifikasi::create([
        'judul'                 => $arsip->judul,
        'nomor_arsip'           => $arsip->nomor_arsip,
        'kategori'              => $arsip->kategori,
        'kode_klasifikasi_id'   => $arsip->kode_klasifikasi_id,
        'indeks'                => $arsip->indeks,
        'uraian_informasi'      => $arsip->uraian_informasi,
        'tanggal'               => $arsip->tanggal,
        'tingkat_perkembangan'  => $arsip->tingkat_perkembangan,
        'jumlah'                => $arsip->jumlah,
        'satuan'                => $arsip->satuan,
        'unit_pengolah_id'      => $arsip->unit_pengolah_id,
        'ruangan'               => $arsip->ruangan,
        'no_box'                => $arsip->no_box,
        'no_filling'            => $arsip->no_filling,
        'no_laci'               => $arsip->no_laci,
        'no_folder'             => $arsip->no_folder,
        'keterangan'            => $arsip->keterangan,
        'skkaad'                => $arsip->skkaad,
        'upload_dokumen'        => $arsip->upload_dokumen,
    ]);
}


    return redirect()->route('arsip.index')->with('success', 'Data arsip berhasil disimpan!');
}



    public function destroy($id)
    {
        $arsip = ArsipUnit::findOrFail($id);
        $arsip->delete();

        return redirect()->route('arsip.index')->with('success', 'Data berhasil dihapus');
    }
}
