<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('arsip_publik', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->string('nomor_arsip')->nullable();
    $table->foreignId('kode_klasifikasi_id')->nullable()->constrained('kode_klasifikasi')->nullOnDelete();
    $table->string('kategori')->nullable();
    $table->string('indeks')->nullable();
    $table->text('uraian_informasi')->nullable();
    $table->date('tanggal')->nullable();
    $table->string('tingkat_perkembangan')->nullable();
    $table->integer('jumlah')->nullable();
    $table->string('satuan')->nullable();
    $table->foreignId('unit_pengolah_id')->nullable()->constrained('unit_pengolah')->nullOnDelete();
    $table->string('ruangan')->nullable();
    $table->string('no_box')->nullable();
    $table->string('no_filling')->nullable();
    $table->string('no_laci')->nullable();
    $table->string('no_folder')->nullable();
    $table->string('keterangan')->nullable();
    $table->string('skkaad')->nullable();
    $table->string('upload_dokumen')->nullable();
    $table->timestamps();

                // relasi opsional ke tabel lain
            $table->foreign('kode_klasifikasi_id')->references('id')->on('kode_klasifikasi')->onDelete('set null');
            $table->foreign('unit_pengolah_id')->references('id')->on('unit_pengolah')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_publik');
    }
};
