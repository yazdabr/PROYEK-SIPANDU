<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipUnit extends Model
{
    use HasFactory;

    // Pakai tabel arsip_unit
    protected $table = 'arsip_unit';

    // kalau primary key bukan 'id', sesuaikan
    protected $primaryKey = 'id';

    // kalau tidak ada timestamps (created_at, updated_at), matikan
    public $timestamps = false;

    // field yang bisa diisi
    protected $fillable = [
        'no_kode_klasifikasi',
        'kategori',
        'kategori_berita',
        'judul',
        'indeks',
        'uraian_informasi',
        'tanggal',
        'jumlah',
        'tingkat',
        'perkembangan',
        'ruangan',
        'skkaad',
        'satuan',
        'unit_pengolah_arsip',
        'no_filling',
        'no_laci',
        'no_folder',
        'keterangan',
        'upload_dokumen',
        'nomor_arsip',
    ];

    // Relasi: ArsipUnit belongsTo KodeKlasifikasi
    public function kodeKlasifikasi()
    {
        return $this->belongsTo(KodeKlasifikasi::class, 'kode_klasifikasi_id');
    }

    public function unitPengolah()
    {
        return $this->belongsTo(UnitPengolah::class, 'unit_pengolah_id');
    }



}
