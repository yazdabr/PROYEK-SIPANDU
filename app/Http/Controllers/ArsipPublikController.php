<?php
// app/Http/Controllers/ArsipPublikController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipPublik;

class ArsipPublikController extends Controller
{
    public function index()
    {
        $arsipPublik = ArsipPublik::with(['unitPengolah', 'kodeKlasifikasi'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ppid.dap', compact('arsipPublik'));
    }
    public function destroy($id)
    {
        $item = ArsipPublik::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

}

