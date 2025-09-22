<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipPublik extends Model
{
    use HasFactory;

    protected $table = 'arsip_publik';

    protected $fillable = [
        'judul',
        'nomor_arsip',
        'kode_klasifikasi_id',
        'kategori',
        'indeks',
        'uraian_informasi',
        'tanggal',
        'tingkat_perkembangan',
        'jumlah',
        'satuan',
        'unit_pengolah_id',
        'ruangan',
        'no_box',
        'no_filling',
        'no_laci',
        'no_folder',
        'keterangan',
        'skkaad',
        'upload_dokumen',
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
