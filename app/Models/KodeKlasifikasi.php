<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeKlasifikasi extends Model
{
    use HasFactory;

    protected $table = 'kodeklasifikasi';
    protected $fillable = ['kode','nama'];
}
