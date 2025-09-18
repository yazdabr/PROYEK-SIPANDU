<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsipunit extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'arsipunit';

    // Field yang bisa diisi
    protected $fillable = [
        'judul',
        'nomor',
        'kategori',
        'kode_klasifikasi',
        'indeks',
        'uraian_informasi',
        'tanggal',
        'tingkat_perkembangan',
        'jumlah',
        'satuan',
        'unit_pengolah_arsip',
        'ruangan',
        'no_filling',
        'no_laci',
        'no_folder',
        'keterangan',
        'upload_dokumen'
    ];

    // pastikan tidak ada kolom yang di-hidden:
    protected $hidden = [];
}
