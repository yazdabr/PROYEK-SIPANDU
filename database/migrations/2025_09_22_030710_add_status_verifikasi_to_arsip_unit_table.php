<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('arsip_unit', function (Blueprint $table) {
        $table->enum('status_verifikasi', ['pending', 'publik', 'tidak_publik'])
              ->default('pending')
              ->after('kategori');
    });
}

public function down(): void
{
    Schema::table('arsip_unit', function (Blueprint $table) {
        $table->dropColumn('status_verifikasi');
    });
}

};
