<?php

namespace App\Http\Controllers;

use App\Models\ArsipUnit;
use App\Models\KodeKlasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TmbEditController extends Controller
{
    public function edit($id)
    {
        $tmb = ArsipUnit::findOrFail($id);
        $kodeKlasifikasi = KodeKlasifikasi::all();
        $unitTmb = (object)['id' => 1, 'nama' => 'TMB'];

        return view('uptmb.tmbedit', compact('tmb', 'kodeKlasifikasi', 'unitTmb'));
    }

    public function update(Request $request, $id)
    {
        $tmb = ArsipUnit::findOrFail($id);
        $tmb->update($request->all());

        $request->validate([
            'upload_dokumen' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
        ]);
                // cek apakah ada file baru
        if ($request->hasFile('upload_dokumen')) {
            // hapus file lama jika ada
            if ($tmb->upload_dokumen && Storage::disk('public')->exists($tmb->upload_dokumen)) {
                Storage::disk('public')->delete($tmb->upload_dokumen);
            }

            // simpan file baru ke storage/app/public/dokumen
            $path = $request->file('upload_dokumen')->store('dokumen', 'public');
            $tmb->upload_dokumen = $path;
        }

        $tmb->save();
        return redirect()->route('tmb.index')->with('success', 'Data berhasil diperbarui');
    }

        public function index()
    {
        // Pengecekan Akses Manual untuk UPTMB
        if (Auth::user()->email !== 'uptmb@gmail.com') {
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk melihat halaman ini.');
        }

        return view('uptmb.tmbdashboard');
    }
}
