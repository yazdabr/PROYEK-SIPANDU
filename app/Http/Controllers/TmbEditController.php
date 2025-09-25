<?php

namespace App\Http\Controllers;

use App\Models\ArsipUnit;
use App\Models\KodeKlasifikasi;
use Illuminate\Http\Request;

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
        return redirect()->route('tmb.index')->with('success', 'Data berhasil diperbarui');
    }
}
