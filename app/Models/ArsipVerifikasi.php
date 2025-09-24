<?php

// app/Models/ArsipVerifikasi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipVerifikasi extends Model
{
    use HasFactory;

    protected $table = 'arsip_verifikasi';

    protected $fillable = [
        'judul',
        'nomor_arsip',
        'kode_klasifikasi_id',
        'kategori',
        'kategori_berita', // ✅ tambahkan
        'status_verifikasi',
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
