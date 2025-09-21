<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitPengolah extends Model
{
    use HasFactory;

    protected $table = 'unit_pengolah'; // tabel sesuai db
    protected $fillable = [
        'nama_unit',
        'keterangan',
    ];
}
