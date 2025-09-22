<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('arsip_publik', function (Blueprint $table) {
            $table->boolean('is_publik')
                  ->nullable()
                  ->comment('null = belum verif, 1 = publik, 0 = tidak publik')
                  ->after('unit_pengolah_id'); // letakkan setelah kolom tertentu
        });
    }

    public function down(): void
    {
        Schema::table('arsip_publik', function (Blueprint $table) {
            $table->dropColumn('is_publik');
        });
    }
};
