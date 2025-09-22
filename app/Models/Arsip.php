<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'arsip_publik'; // tabel yang dipakai
    protected $fillable = [
        'judul','nomor_arsip','kategori','kode_klasifikasi_id',
        'indeks','uraian_informasi','tanggal','tingkat_perkembangan',
        'jumlah','satuan','unit_pengolah_id','ruangan','no_box',
        'no_filling','no_laci','no_folder','keterangan','skkaad',
        'upload_dokumen','is_publik'
    ];

    public function unitPengolah()
    {
        return $this->belongsTo(UnitPengolah::class, 'unit_pengolah_id');
    }

    public function kodeKlasifikasi()
    {
        return $this->belongsTo(KodeKlasifikasi::class, 'kode_klasifikasi_id');
    }
}
