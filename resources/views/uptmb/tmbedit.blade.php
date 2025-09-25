<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Arsip Unit - SIPANDU</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
/* Hilangkan tombol "x" (clear) */
.select2-selection__clear { display: none !important; }
/* Hilangkan icon dropdown panah */
.select2-selection__arrow { display: none !important; }
/* Biar teks tetap rata kiri penuh */
.select2-container .select2-selection--single {
    padding-right: 0 !important;
    height: 45px !important;
    line-height: 45px !important;
    font-size: 16px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 45px !important;
    padding-left: 10px !important;
}
</style>

<body class="flex min-h-screen bg-[#EDF2F9]">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#8E9BAB] text-white flex flex-col">
        <div class="px-3 py-2 bg-[#68778B] flex items-center">
            <img src="/images/logo.png" class="h-16">
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">
                Selamat Datang
            </div>
            <a href="{{ url('/uptmb/tmbdashboard') }}" class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>
            <a href="{{ url('/uptmb/tmbinput') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold text-[#003B69]">
                <img src="/images/inputbiru.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Input Arsip</span>
            </a>
            <a href="{{ url('/uptmb/tmb') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Unit</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded">Unit Pengolah TMB</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </form>
        </header>

        <!-- Content -->
        <main class="p-6 space-y-6">
            <!-- Form Edit Arsip -->
            <form action="{{ route('tmb.update', $tmb->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="bg-white p-6 rounded shadow">
                    <h2 class="font-bold text-lg text-[#003B69] mb-4">Edit Arsip</h2>
                    <div class="space-y-4">

                        <!-- Nama Berkas -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Judul</label>
                            <input type="text" name="judul" class="w-full border rounded px-3 py-2" value="{{ $tmb->judul }}" required>
                        </div>

                        <!-- Nomor Berkas -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Nomor</label>
                            <input type="text" name="nomor" class="w-full border rounded px-3 py-2" value="{{ $tmb->nomor_arsip }}">
                        </div>

                        <!-- Kode Klasifikasi -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Kode Klasifikasi</label>
                            <div class="relative w-full">
                                <select id="kode_klasifikasi" name="kode_klasifikasi" class="w-full border rounded px-3 py-2 text-gray-500" required>
                                    <option value="">-</option>
                                    @foreach($kodeKlasifikasi as $kode)
                                        <option value="{{ $kode->id }}" {{ $tmb->kode_klasifikasi_id == $kode->id ? 'selected' : '' }}>
                                            {{ $kode->kode }} - {{ $kode->uraian }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- Kategori Berita -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Kategori</label>
                            <div class="relative w-full">
<select id="kategori_berita" name="kategori_berita" class="w-full border rounded px-3 py-2 text-gray-500">
    <option value="-" {{ $tmb->kategori_berita == '-' ? 'selected' : '' }}>-</option>
    <option value="Keputusan LPP RRI dan Pertimbangannya (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Keputusan LPP RRI dan Pertimbangannya (Tersedia setiap saat)' ? 'selected' : '' }}>
        Keputusan LPP RRI dan Pertimbangannya (Tersedia setiap saat)
    </option>
    <option value="Kebijakan LPP RRI dan Dokumen Pendukungnya (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Kebijakan LPP RRI dan Dokumen Pendukungnya (Tersedia setiap saat)' ? 'selected' : '' }}>
        Kebijakan LPP RRI dan Dokumen Pendukungnya (Tersedia setiap saat)
    </option>
    <option value="Rencana Proyek dan Anggaran Tahunnya (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Rencana Proyek dan Anggaran Tahunnya (Tersedia setiap saat)' ? 'selected' : '' }}>
        Rencana Proyek dan Anggaran Tahunnya (Tersedia setiap saat)
    </option>
    <option value="Rencana Strategis LPP RRI (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Rencana Strategis LPP RRI (Tersedia setiap saat)' ? 'selected' : '' }}>
        Rencana Strategis LPP RRI (Tersedia setiap saat)
    </option>
    <option value="Informasi tentang PPID LPP RRI (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Informasi tentang PPID LPP RRI (Tersedia setiap saat)' ? 'selected' : '' }}>
        Informasi tentang PPID LPP RRI (Tersedia setiap saat)
    </option>
    <option value="Informasi tentang Penindakan atas Pelanggaran yang dilakukan oleh Pegawai LPP RRI (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Informasi tentang Penindakan atas Pelanggaran yang dilakukan oleh Pegawai LPP RRI (Tersedia setiap saat)' ? 'selected' : '' }}>
        Informasi tentang Penindakan atas Pelanggaran yang dilakukan oleh Pegawai LPP RRI (Tersedia setiap saat)
    </option>
    <option value="Informasi Daftar dan Hasil Penelitian LPP RRI (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Informasi Daftar dan Hasil Penelitian LPP RRI (Tersedia setiap saat)' ? 'selected' : '' }}>
        Informasi Daftar dan Hasil Penelitian LPP RRI (Tersedia setiap saat)
    </option>
    <option value="Informasi Laporan Harta Kekayaan Pejabat Negara di LPP RRI yang telah diverifikasi oleh KPK (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Informasi Laporan Harta Kekayaan Pejabat Negara di LPP RRI yang telah diverifikasi oleh KPK (Tersedia setiap saat)' ? 'selected' : '' }}>
        Informasi Laporan Harta Kekayaan Pejabat Negara di LPP RRI yang telah diverifikasi oleh KPK (Tersedia setiap saat)
    </option>
    <option value="Perjanjian LPP RRI dengan Pihak Ketiga (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Perjanjian LPP RRI dengan Pihak Ketiga (Tersedia setiap saat)' ? 'selected' : '' }}>
        Perjanjian LPP RRI dengan Pihak Ketiga (Tersedia setiap saat)
    </option>
    <option value="Informasi dalam pertemuan yang bersifat untuk umum (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Informasi dalam pertemuan yang bersifat untuk umum (Tersedia setiap saat)' ? 'selected' : '' }}>
        Informasi dalam pertemuan yang bersifat untuk umum (Tersedia setiap saat)
    </option>
    <option value="Prosedur Kerja yang Berkaitan dengan Publik (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Prosedur Kerja yang Berkaitan dengan Publik (Tersedia setiap saat)' ? 'selected' : '' }}>
        Prosedur Kerja yang Berkaitan dengan Publik (Tersedia setiap saat)
    </option>
    <option value="Laporan Layanan Akses Informasi (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Laporan Layanan Akses Informasi (Tersedia setiap saat)' ? 'selected' : '' }}>
        Laporan Layanan Akses Informasi (Tersedia setiap saat)
    </option>
    <option value="Profil Lengkap Pimpinan dan Pegawai (Tersedia setiap saat)" 
        {{ $tmb->kategori_berita == 'Profil Lengkap Pimpinan dan Pegawai (Tersedia setiap saat)' ? 'selected' : '' }}>
        Profil Lengkap Pimpinan dan Pegawai (Tersedia setiap saat)
    </option>
    <option value="Informasi Berkaitan dengan Profile LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Informasi Berkaitan dengan Profile LPP RRI (Berkala)' ? 'selected' : '' }}>
        Informasi Berkaitan dengan Profile LPP RRI (Berkala)
    </option>
    <option value="Alamat LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Alamat LPP RRI (Berkala)' ? 'selected' : '' }}>
        Alamat LPP RRI (Berkala)
    </option>
    <option value="Struktur Organisasi (Berkala)" 
        {{ $tmb->kategori_berita == 'Struktur Organisasi (Berkala)' ? 'selected' : '' }}>
        Struktur Organisasi (Berkala)
    </option>
    <option value="Sejarah Singkat LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Sejarah Singkat LPP RRI (Berkala)' ? 'selected' : '' }}>
        Sejarah Singkat LPP RRI (Berkala)
    </option>
    <option value="Profil Pejabat LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Profil Pejabat LPP RRI (Berkala)' ? 'selected' : '' }}>
        Profil Pejabat LPP RRI (Berkala)
    </option>
    <option value="RKAKL LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'RKAKL LPP RRI (Berkala)' ? 'selected' : '' }}>
        RKAKL LPP RRI (Berkala)
    </option>
    <option value="Informasi Agenda Terkait Pelaksanaan Tugas LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Informasi Agenda Terkait Pelaksanaan Tugas LPP RRI (Berkala)' ? 'selected' : '' }}>
        Informasi Agenda Terkait Pelaksanaan Tugas LPP RRI (Berkala)
    </option>
    <option value="DIPA (Berkala)" 
        {{ $tmb->kategori_berita == 'DIPA (Berkala)' ? 'selected' : '' }}>
        DIPA (Berkala)
    </option>
    <option value="Informasi Penerimaan Calon Pegawai LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Informasi Penerimaan Calon Pegawai LPP RRI (Berkala)' ? 'selected' : '' }}>
        Informasi Penerimaan Calon Pegawai LPP RRI (Berkala)
    </option>
    <option value="Laporan Keuangan Audited (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Keuangan Audited (Berkala)' ? 'selected' : '' }}>
        Laporan Keuangan Audited (Berkala)
    </option>
    <option value="Rencana dan LRA (Berkala)" 
        {{ $tmb->kategori_berita == 'Rencana dan LRA (Berkala)' ? 'selected' : '' }}>
        Rencana dan LRA (Berkala)
    </option>
    <option value="Neraca Keuangan (Berkala)" 
        {{ $tmb->kategori_berita == 'Neraca Keuangan (Berkala)' ? 'selected' : '' }}>
        Neraca Keuangan (Berkala)
    </option>
    <option value="Laporan Arus Kas dan CaLK (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Arus Kas dan CaLK (Berkala)' ? 'selected' : '' }}>
        Laporan Arus Kas dan CaLK (Berkala)
    </option>
    <option value="Daftar Investasi dan Asset (Administrasi BMN) (Berkala)" 
        {{ $tmb->kategori_berita == 'Daftar Investasi dan Asset (Administrasi BMN) (Berkala)' ? 'selected' : '' }}>
        Daftar Investasi dan Asset (Administrasi BMN) (Berkala)
    </option>
    <option value="Acara Siaran (Berkala)" 
        {{ $tmb->kategori_berita == 'Acara Siaran (Berkala)' ? 'selected' : '' }}>
        Acara Siaran (Berkala)
    </option>
    <option value="Laporan Bidang TMB (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Bidang TMB (Berkala)' ? 'selected' : '' }}>
        Laporan Bidang TMB (Berkala)
    </option>
    <option value="Laporan Bidang Pemberitaan/Tim Penyiaran (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Bidang Pemberitaan/Tim Penyiaran (Berkala)' ? 'selected' : '' }}>
        Laporan Bidang Pemberitaan/Tim Penyiaran (Berkala)
    </option>
    <option value="Laporan Bidang Siaran/Tim Konten Media Baru (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Bidang Siaran/Tim Konten Media Baru (Berkala)' ? 'selected' : '' }}>
        Laporan Bidang Siaran/Tim Konten Media Baru (Berkala)
    </option>
    <option value="Laporan Bidang LPU (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Bidang LPU (Berkala)' ? 'selected' : '' }}>
        Laporan Bidang LPU (Berkala)
    </option>
    <option value="Laporan Bidang SDM dan Umum (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Bidang SDM dan Umum (Berkala)' ? 'selected' : '' }}>
        Laporan Bidang SDM dan Umum (Berkala)
    </option>
    <option value="Daftar Informasi Publik LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Daftar Informasi Publik LPP RRI (Berkala)' ? 'selected' : '' }}>
        Daftar Informasi Publik LPP RRI (Berkala)
    </option>
    <option value="Laporan Akuntabilitas (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Akuntabilitas (Berkala)' ? 'selected' : '' }}>
        Laporan Akuntabilitas (Berkala)
    </option>
    <option value="ELHKPN LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'ELHKPN LPP RRI (Berkala)' ? 'selected' : '' }}>
        ELHKPN LPP RRI (Berkala)
    </option>
    <option value="Regulasi dan Rancangan Keterbukaan Informasi Publik (Berkala)" 
        {{ $tmb->kategori_berita == 'Regulasi dan Rancangan Keterbukaan Informasi Publik (Berkala)' ? 'selected' : '' }}>
        Regulasi dan Rancangan Keterbukaan Informasi Publik (Berkala)
    </option>
    <option value="Rancangan Peraturan di LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Rancangan Peraturan di LPP RRI (Berkala)' ? 'selected' : '' }}>
        Rancangan Peraturan di LPP RRI (Berkala)
    </option>
    <option value="Regulasi LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Regulasi LPP RRI (Berkala)' ? 'selected' : '' }}>
        Regulasi LPP RRI (Berkala)
    </option>
    <option value="SOP (Berkala)" 
        {{ $tmb->kategori_berita == 'SOP (Berkala)' ? 'selected' : '' }}>
        SOP (Berkala)
    </option>
    <option value="Pengadaan Barang dan Jasa (Berkala)" 
        {{ $tmb->kategori_berita == 'Pengadaan Barang dan Jasa (Berkala)' ? 'selected' : '' }}>
        Pengadaan Barang dan Jasa (Berkala)
    </option>
    <option value="Standar Pelayanan (Berkala)" 
        {{ $tmb->kategori_berita == 'Standar Pelayanan (Berkala)' ? 'selected' : '' }}>
        Standar Pelayanan (Berkala)
    </option>
    <option value="Maklumat Pelayanan (Berkala)" 
        {{ $tmb->kategori_berita == 'Maklumat Pelayanan (Berkala)' ? 'selected' : '' }}>
        Maklumat Pelayanan (Berkala)
    </option>
    <option value="Ringkasan Program Strategis LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Ringkasan Program Strategis LPP RRI (Berkala)' ? 'selected' : '' }}>
        Ringkasan Program Strategis LPP RRI (Berkala)
    </option>
    <option value="Dokumen Surat Menyurat (Berkala)" 
        {{ $tmb->kategori_berita == 'Dokumen Surat Menyurat (Berkala)' ? 'selected' : '' }}>
        Dokumen Surat Menyurat (Berkala)
    </option>
    <option value="Informasi Terkait Penanganan Covid-19 (Berkala)" 
        {{ $tmb->kategori_berita == 'Informasi Terkait Penanganan Covid-19 (Berkala)' ? 'selected' : '' }}>
        Informasi Terkait Penanganan Covid-19 (Berkala)
    </option>
    <option value="Opini BPK RI atas Laporan Keuangan LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Opini BPK RI atas Laporan Keuangan LPP RRI (Berkala)' ? 'selected' : '' }}>
        Opini BPK RI atas Laporan Keuangan LPP RRI (Berkala)
    </option>
    <option value="Penyelenggaraan Satu Data Indonesia (Berkala)" 
        {{ $tmb->kategori_berita == 'Penyelenggaraan Satu Data Indonesia (Berkala)' ? 'selected' : '' }}>
        Penyelenggaraan Satu Data Indonesia (Berkala)
    </option>
    <option value="Bintang Radio RRI Tingkat Nasional (Berkala)" 
        {{ $tmb->kategori_berita == 'Bintang Radio RRI Tingkat Nasional (Berkala)' ? 'selected' : '' }}>
        Bintang Radio RRI Tingkat Nasional (Berkala)
    </option>
    <option value="Formulir Pendaftaran PTQ RRI ke-53 Tahun 2023 (Berkala)" 
        {{ $tmb->kategori_berita == 'Formulir Pendaftaran PTQ RRI ke-53 Tahun 2023 (Berkala)' ? 'selected' : '' }}>
        Formulir Pendaftaran PTQ RRI ke-53 Tahun 2023 (Berkala)
    </option>
    <option value="Informasi Publik dalam Bahasa Isyarat Indonesia (BISINDO) (Berkala)" 
        {{ $tmb->kategori_berita == 'Informasi Publik dalam Bahasa Isyarat Indonesia (BISINDO) (Berkala)' ? 'selected' : '' }}>
        Informasi Publik dalam Bahasa Isyarat Indonesia (BISINDO) (Berkala)
    </option>
    <option value="LHKPN Kepala RRI Seluruh Indonesia (Berkala)" 
        {{ $tmb->kategori_berita == 'LHKPN Kepala RRI Seluruh Indonesia (Berkala)' ? 'selected' : '' }}>
        LHKPN Kepala RRI Seluruh Indonesia (Berkala)
    </option>
    <option value="Press Release (Berkala)" 
        {{ $tmb->kategori_berita == 'Press Release (Berkala)' ? 'selected' : '' }}>
        Press Release (Berkala)
    </option>
    <option value="Formulir Pendaftaran PTQ RRI ke-54 Tahun 2024 (Berkala)" 
        {{ $tmb->kategori_berita == 'Formulir Pendaftaran PTQ RRI ke-54 Tahun 2024 (Berkala)' ? 'selected' : '' }}>
        Formulir Pendaftaran PTQ RRI ke-54 Tahun 2024 (Berkala)
    </option>
    <option value="Laporan Tahunan LPP RRI (Berkala)" 
        {{ $tmb->kategori_berita == 'Laporan Tahunan LPP RRI (Berkala)' ? 'selected' : '' }}>
        Laporan Tahunan LPP RRI (Berkala)
    </option>
    <option value="Rencana Umum Pengadaan (Berkala)" 
        {{ $tmb->kategori_berita == 'Rencana Umum Pengadaan (Berkala)' ? 'selected' : '' }}>
        Rencana Umum Pengadaan (Berkala)
    </option>
    <option value="Peraturan, Keputusan dan Kebijakan (Berkala)" 
        {{ $tmb->kategori_berita == 'Peraturan, Keputusan dan Kebijakan (Berkala)' ? 'selected' : '' }}>
        Peraturan, Keputusan dan Kebijakan (Berkala)
    </option>
    <option value="Regulasi Pedoman Pengelolaan Informasi (Berkala)" 
        {{ $tmb->kategori_berita == 'Regulasi Pedoman Pengelolaan Informasi (Berkala)' ? 'selected' : '' }}>
        Regulasi Pedoman Pengelolaan Informasi (Berkala)
    </option>
    <option value="Regulasi Pedoman Pengelolaan Administrasi (Berkala)" 
        {{ $tmb->kategori_berita == 'Regulasi Pedoman Pengelolaan Administrasi (Berkala)' ? 'selected' : '' }}>
        Regulasi Pedoman Pengelolaan Administrasi (Berkala)
    </option>
    <option value="Regulasi Pedoman Pengelolaan Personil (Berkala)" 
        {{ $tmb->kategori_berita == 'Regulasi Pedoman Pengelolaan Personil (Berkala)' ? 'selected' : '' }}>
        Regulasi Pedoman Pengelolaan Personil (Berkala)
    </option>
    <option value="Rancangan Peraturan (Berkala)" 
        {{ $tmb->kategori_berita == 'Rancangan Peraturan (Berkala)' ? 'selected' : '' }}>
        Rancangan Peraturan (Berkala)
    </option>
    <option value="Masukan dari Berbagai Pihak atas Peraturan, Keputusan atau Kebijakan (Berkala)" 
        {{ $tmb->kategori_berita == 'Masukan dari Berbagai Pihak atas Peraturan, Keputusan atau Kebijakan (Berkala)' ? 'selected' : '' }}>
        Masukan dari Berbagai Pihak atas Peraturan, Keputusan atau Kebijakan (Berkala)
    </option>
    <option value="Risalah Rapat dari Proses Pembentukan Peraturan, Keputusan atau Kebijakan (Berkala)" 
        {{ $tmb->kategori_berita == 'Risalah Rapat dari Proses Pembentukan Peraturan, Keputusan atau Kebijakan (Berkala)' ? 'selected' : '' }}>
        Risalah Rapat dari Proses Pembentukan Peraturan, Keputusan atau Kebijakan (Berkala)
    </option>
    <option value="Dokumen Rancangan Peraturan, Keputusan Kebijakan yang dibentuk (Berkala)" 
        {{ $tmb->kategori_berita == 'Dokumen Rancangan Peraturan, Keputusan Kebijakan yang dibentuk (Berkala)' ? 'selected' : '' }}>
        Dokumen Rancangan Peraturan, Keputusan Kebijakan yang dibentuk (Berkala)
    </option>
    <option value="Dokumen Penghargaan (Berkala)" 
        {{ $tmb->kategori_berita == 'Dokumen Penghargaan (Berkala)' ? 'selected' : '' }}>
        Dokumen Penghargaan (Berkala)
    </option>
    <option value="LHKPN Dewas dan Direksi (Berkala)" 
        {{ $tmb->kategori_berita == 'LHKPN Dewas dan Direksi (Berkala)' ? 'selected' : '' }}>
        LHKPN Dewas dan Direksi (Berkala)
    </option>
    <option value="Hasil Monitoring dan Evaluasi KIP (Berkala)" 
        {{ $tmb->kategori_berita == 'Hasil Monitoring dan Evaluasi KIP (Berkala)' ? 'selected' : '' }}>
        Hasil Monitoring dan Evaluasi KIP (Berkala)
    </option>
    <option value="Pedoman HUT LPP RRI 80th (Berkala)" 
        {{ $tmb->kategori_berita == 'Pedoman HUT LPP RRI 80th (Berkala)' ? 'selected' : '' }}>
        Pedoman HUT LPP RRI 80th (Berkala)
    </option>
    <option value="Informasi yang Wajib Diumumkan Tanpa Penundaan (Serta Merta)" 
        {{ $tmb->kategori_berita == 'Informasi yang Wajib Diumumkan Tanpa Penundaan (Serta Merta)' ? 'selected' : '' }}>
        Informasi yang Wajib Diumumkan Tanpa Penundaan (Serta Merta)
    </option>
    <option value="Menyangkut Ancaman Terhadap Hajat Hidup Orang Banyak dan Ketertiban Umum (Serta Merta)" 
        {{ $tmb->kategori_berita == 'Menyangkut Ancaman Terhadap Hajat Hidup Orang Banyak dan Ketertiban Umum (Serta Merta)' ? 'selected' : '' }}>
        Menyangkut Ancaman Terhadap Hajat Hidup Orang Banyak dan Ketertiban Umum (Serta Merta)
    </option>
    <option value="Pasal 17 UU 14 Tahun 2008 (Dikecualikan)" 
        {{ $tmb->kategori_berita == 'Pasal 17 UU 14 Tahun 2008 (Dikecualikan)' ? 'selected' : '' }}>
        Pasal 17 UU 14 Tahun 2008 (Dikecualikan)
    </option>
</select>

                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>
                        <input type="hidden" id="kategori" name="kategori" value="{{ $tmb->kategori }}">

                        <!-- Indeks -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Indeks</label>
                            <input type="text" name="indeks" class="w-full border rounded px-3 py-2" value="{{ $tmb->indeks }}">
                        </div>

                        <!-- Uraian Informasi -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Uraian Informasi</label>
                            <textarea name="uraian_informasi" class="w-full border rounded px-3 py-2">{{ $tmb->uraian_informasi }}</textarea>
                        </div>

                        <!-- Tanggal -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Tanggal</label>
                            <input type="date" name="tanggal" class="w-full border rounded px-3 py-2 text-gray-500" value="{{ $tmb->tanggal }}">
                        </div>

                    <!-- Tingkat Perkembangan -->
                    <div>
                        <label class="font-medium mb-1 block">Tingkat Perkembangan</label>
                        <div class="relative max-w-5xl">
                        <select name="tingkat_perkembangan" 
                                class="w-full max-w-5xl border rounded px-3 py-2 appearance-none" required>
                            <option value="Asli" {{ old('tingkat_perkembangan', $tmb->tingkat_perkembangan) == 'Asli' ? 'selected' : '' }}>Asli</option>
                            <option value="Fotocopy" {{ old('tingkat_perkembangan', $tmb->tingkat_perkembangan) == 'Fotocopy' ? 'selected' : '' }}>Fotocopy</option>
                            <option value="Asli & Fotocopy" {{ old('tingkat_perkembangan', $tmb->tingkat_perkembangan) == 'Asli & Fotocopy' ? 'selected' : '' }}>Asli & Fotocopy</option>
                            <option value="Softcopy" {{ old('tingkat_perkembangan', $tmb->tingkat_perkembangan) == 'Softcopy' ? 'selected' : '' }}>Softcopy</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                        </div>
                    </div>

                        <!-- Jumlah -->
                        <div class="w-full max-w-2xl">
                            <label class="font-medium mb-1 block">Jumlah</label>
                            <div class="flex items-center gap-3">
                                <input type="number" name="jumlah" min="0" class="w-32 border rounded px-3 py-2 text-center" placeholder="0" value="{{ $tmb->jumlah }}">
                                <div class="relative w-40">
                                  <select 
                                    name="satuan" 
                                    class="w-full border rounded px-3 py-2 text-center text-gray-500 appearance-none" 
                                    required
                                >
                                    <option value="lembar" {{ old('satuan', $tmb->satuan) == 'lembar' ? 'selected' : '' }}>Lembar</option>
                                    <option value="jilid" {{ old('satuan', $tmb->satuan) == 'jilid' ? 'selected' : '' }}>Jilid</option>
                                    <option value="bundle" {{ old('satuan', $tmb->satuan) == 'bundle' ? 'selected' : '' }}>Bundle</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">
                                    ▼
                                </div>
                            </div>
                        </div>

                        <!-- Unit Pengolah Arsip -->
                        <div class="w-full max-w-2xl">
                            <label class="font-medium mb-1 block">Unit Pengolah Arsip</label>
                            <input type="text" value="TMB" class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700" readonly>
                            <input type="hidden" name="unit_pengolah_id" value="{{ $unitTmb->id }}">
                        </div>
                    </div>
                </div>

                <!-- Form Lokasi Arsip -->
                <div class="bg-white p-6 rounded shadow mt-6">
                    <h2 class="font-semibold text-lg text-[#003B69] mb-4">Lokasi Arsip</h2>
                    <div class="space-y-4">
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Ruangan</label>
                            <input type="text" name="ruangan" class="w-full border rounded px-3 py-2" value="{{ $tmb->ruangan }}">
                        </div>
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">No Box</label>
                            <input type="text" name="no_box" class="w-full border rounded px-3 py-2" value="{{ $tmb->no_box }}">
                        </div>
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">No Filling</label>
                            <input type="text" name="no_filling" class="w-full border rounded px-3 py-2" value="{{ $tmb->no_filling }}">
                        </div>
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">No Laci</label>
                            <input type="text" name="no_laci" class="w-full border rounded px-3 py-2" value="{{ $tmb->no_laci }}">
                        </div>
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">No Folder</label>
                            <input type="text" name="no_folder" class="w-full border rounded px-3 py-2" value="{{ $tmb->no_folder }}">
                        </div>
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Keterangan</label>
                            <textarea name="keterangan" class="w-full border rounded px-3 py-2">{{ $tmb->keterangan }}</textarea>
                        </div>
                        <div>
                            <label class="font-medium mb-1 block">Upload Dokumen</label>
                            <input type="file" name="upload_dokumen" class="w-full max-w-5xl border rounded px-3 py-2">
                            @if($tmb->upload_dokumen)
                                <p class="mt-2">Files lama: 
                                    <a href="{{ asset('storage/'.$tmb->upload_dokumen) }}" target="_blank" class="text-blue-600 underline">
                                        Lihat Dokumen
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-3 mt-8">
                        <a href="{{ route('tmb.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded shadow hover:bg-gray-500">Kembali</a>
                        <button type="submit" class="bg-[#003B69] text-white px-4 py-2 rounded shadow hover:bg-blue-900">Simpan</button>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kategori_berita').select2();
            $('#kode_klasifikasi').select2();

            document.getElementById('kategori_berita').addEventListener('change', function () {
                let val = this.value;
                let kategoriInput = document.getElementById('kategori');
                kategoriInput.value = (val === '-') ? '-' : 'PPID';
            });
        });
    </script>

</body>
</html>
