<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('arsip_verifikasi', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->string('nomor_arsip');
    $table->enum('kategori', ['-', 'PPID'])->default('-');

    // ubah jadi unsignedBigInteger supaya cocok dengan id tabel kode_klasifikasi
    $table->unsignedBigInteger('kode_klasifikasi_id')->nullable();
    $table->foreign('kode_klasifikasi_id')
        ->references('id')->on('kode_klasifikasi')
        ->onDelete('set null');

    $table->string('indeks')->nullable();
    $table->text('uraian_informasi')->nullable();
    $table->date('tanggal')->nullable();
    $table->string('tingkat_perkembangan')->nullable();
    $table->integer('jumlah')->nullable();
    $table->string('satuan')->nullable();

    $table->unsignedBigInteger('unit_pengolah_id')->nullable();
    $table->foreign('unit_pengolah_id')
        ->references('id')->on('unit_pengolah')
        ->onDelete('set null');

    $table->string('ruangan')->nullable();
    $table->string('no_box')->nullable();
    $table->string('no_filling')->nullable();
    $table->string('no_laci')->nullable();
    $table->string('no_folder')->nullable();
    $table->text('keterangan')->nullable();
    $table->string('skkaad')->nullable();
    $table->string('upload_dokumen')->nullable();
    $table->enum('status_verifikasi', ['publik', 'tidak'])->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_verifikasi');
    }
};
