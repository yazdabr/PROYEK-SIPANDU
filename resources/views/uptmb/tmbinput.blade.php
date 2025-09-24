<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Pengolah - SIPANDU</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
/* Hilangkan tombol "x" (clear) */
.select2-selection__clear {
    display: none !important;
}

/* Hilangkan icon dropdown panah */
.select2-selection__arrow {
    display: none !important;
}

/* Biar teks tetap rata kiri penuh */
.select2-container .select2-selection--single {
    padding-right: 0 !important;
}
.select2-container .select2-selection--single {
    height: 45px !important;       /* atur tinggi */
    line-height: 45px !important;  /* biar teks di tengah */
    font-size: 16px;               /* opsional: perbesar font */
}

/* Supaya tulisan di dalam tidak nempel ke tepi */
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

            <a href="{{ url('/uptmb/tmbdashboard') }}"
               class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/uptmb/tmbinput') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold text-[#003B69]">
                <img src="/images/inputbiru.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Input Arsip</span>
            </a>

            <a href="{{ url('/uptmb/tmb') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Unit</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded">
                Unit Pengolah TMB
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </form>
        </header>

        <!-- Content -->
        <main class="p-6 space-y-6">
            
            <!-- Form Input Arsip -->
            <form action="{{ route('tmb.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="bg-white p-6 rounded shadow">
                    <h2 class="font-bold text-lg text-[#003B69] mb-4">Input Arsip</h2>
                    <div class="space-y-4">

                        <!-- Nama Berkas -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Nama Berkas</label>
                            <input type="text" name="judul" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <!-- Nomor Berkas -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Nomor</label>
                            <input type="text" name="nomor" class="w-full border rounded px-3 py-2">
                        </div>

                        <!-- Kode Klasifikasi -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Kode Klasifikasi</label>
                            <div class="relative w-full">
                                <select id="kode_klasifikasi" name="kode_klasifikasi" class="w-full border rounded px-3 py-2 text-gray-500" required>
                                    <option value="">-</option>
                                    @foreach($kodeKlasifikasi as $kode)
                                        <option value="{{ $kode->id }}">{{ $kode->kode }} - {{ $kode->uraian }}</option>
                                    @endforeach
                                </select>
                                
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- Kategori Berita -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Kategori</label>
                            <div class="relative w-full">
                                <select id="kategori_berita" name="kategori_berita" 
                                    class="w-full border rounded px-3 py-2 text-gray-500 appearance-none">
                                        <option value="-">-</option>
                                        <option value="Keputusan LPP RRI dan Pertimbangannya (Tersedia setiap saat)">Keputusan LPP RRI dan Pertimbangannya (Tersedia setiap saat)</option>
                                        <option value="Kebijakan LPP RRI dan Dokumen Pendukungnya (Tersedia setiap saat)">Kebijakan LPP RRI dan Dokumen Pendukungnya (Tersedia setiap saat)</option>
                                        <option value="Rencana Proyek dan Anggaran Tahunnya (Tersedia setiap saat)">Rencana Proyek dan Anggaran Tahunnya (Tersedia setiap saat)</option>
                                        <option value="Rencana Strategis LPP RRI (Tersedia setiap saat)">Rencana Strategis LPP RRI (Tersedia setiap saat)</option>
                                        <option value="Informasi tentang PPID LPP RRI (Tersedia setiap saat)">Informasi tentang PPID LPP RRI (Tersedia setiap saat)</option>
                                        <option value="Informasi tentang Penindakan atas Pelanggaran yang dilakukan oleh Pegawai LPP RRI (Tersedia setiap saat)">Informasi tentang Penindakan atas Pelanggaran yang dilakukan oleh Pegawai LPP RRI (Tersedia setiap saat)</option>
                                        <option value="Informasi Daftar dan Hasil Penelitian LPP RRI (Tersedia setiap saat)">Informasi Daftar dan Hasil Penelitian LPP RRI (Tersedia setiap saat)</option>
                                        <option value="Informasi Laporan Harta Kekayaan Pejabat Negara di LPP RRI yang telah diverifikasi oleh KPK (Tersedia setiap saat)">Informasi Laporan Harta Kekayaan Pejabat Negara di LPP RRI yang telah diverifikasi oleh KPK (Tersedia setiap saat)</option>
                                        <option value="Perjanjian LPP RRI dengan Pihak Ketiga (Tersedia setiap saat)">Perjanjian LPP RRI dengan Pihak Ketiga (Tersedia setiap saat)</option>
                                        <option value="Informasi dalam pertemuan yang bersifat untuk umum (Tersedia setiap saat)">Informasi dalam pertemuan yang bersifat untuk umum (Tersedia setiap saat)</option>
                                        <option value="Prosedur Kerja yang Berkaitan dengan Publik (Tersedia setiap saat)">Prosedur Kerja yang Berkaitan dengan Publik (Tersedia setiap saat)</option>
                                        <option value="Laporan Layanan Akses Informasi (Tersedia setiap saat)">Laporan Layanan Akses Informasi (Tersedia setiap saat)</option>
                                        <option value="Profil Lengkap Pimpinan dan Pegawai (Tersedia setiap saat)">Profil Lengkap Pimpinan dan Pegawai (Tersedia setiap saat)</option>
                                        <option value="Informasi Berkaitan dengan Profile LPP RRI (Berkala)">Informasi Berkaitan dengan Profile LPP RRI (Berkala)</option>
                                        <option value="Alamat LPP RRI (Berkala)">Alamat LPP RRI (Berkala)</option>
                                        <option value="Struktur Organisasi (Berkala)">Struktur Organisasi (Berkala)</option>
                                        <option value="Sejarah Singkat LPP RRI (Berkala)">Sejarah Singkat LPP RRI (Berkala)</option>
                                        <option value="Profil Pejabat LPP RRI (Berkala)">Profil Pejabat LPP RRI (Berkala)</option>
                                        <option value="RKAKL LPP RRI (Berkala)">RKAKL LPP RRI (Berkala)</option>
                                        <option value="Informasi Agenda Terkait Pelaksanaan Tugas LPP RRI (Berkala)">Informasi Agenda Terkait Pelaksanaan Tugas LPP RRI (Berkala)</option>
                                        <option value="DIPA (Berkala)">DIPA (Berkala)</option>
                                        <option value="Informasi Penerimaan Calon Pegawai LPP RRI (Berkala)">Informasi Penerimaan Calon Pegawai LPP RRI (Berkala)</option>
                                        <option value="Laporan Keuangan Audited (Berkala)">Laporan Keuangan Audited (Berkala)</option>
                                        <option value="Rencana dan LRA (Berkala)">Rencana dan LRA (Berkala)</option>
                                        <option value="Neraca Keuangan (Berkala)">Neraca Keuangan (Berkala)</option>
                                        <option value="Laporan Arus Kas dan CaLK (Berkala)">Laporan Arus Kas dan CaLK (Berkala)</option>
                                        <option value="Daftar Investasi dan Asset (Administrasi BMN) (Berkala)">Daftar Investasi dan Asset (Administrasi BMN) (Berkala)</option>
                                        <option value="Acara Siaran (Berkala)">Acara Siaran (Berkala)</option>
                                        <option value="Laporan Bidang TMB (Berkala)">Laporan Bidang TMB (Berkala)</option>
                                        <option value="Laporan Bidang Pemberitaan/Tim Penyiaran (Berkala)">Laporan Bidang Pemberitaan/Tim Penyiaran (Berkala)</option>
                                        <option value="Laporan Bidang Siaran/Tim Konten Media Baru (Berkala)">Laporan Bidang Siaran/Tim Konten Media Baru (Berkala)</option>
                                        <option value="Laporan Bidang LPU (Berkala)">Laporan Bidang LPU (Berkala)</option>
                                        <option value="Laporan Bidang SDM dan Umum (Berkala)">Laporan Bidang SDM dan Umum (Berkala)</option>
                                        <option value="Daftar Informasi Publik LPP RRI (Berkala)">Daftar Informasi Publik LPP RRI (Berkala)</option>
                                        <option value="Laporan Akuntabilitas (Berkala)">Laporan Akuntabilitas (Berkala)</option>
                                        <option value="ELHKPN LPP RRI (Berkala)">ELHKPN LPP RRI (Berkala)</option>
                                        <option value="Regulasi dan Rancangan Keterbukaan Informasi Publik (Berkala)">Regulasi dan Rancangan Keterbukaan Informasi Publik (Berkala)</option>
                                        <option value="Rancangan Peraturan di LPP RRI (Berkala)">Rancangan Peraturan di LPP RRI (Berkala)</option>
                                        <option value="Regulasi LPP RRI (Berkala)">Regulasi LPP RRI (Berkala)</option>
                                        <option value="SOP (Berkala)">SOP (Berkala)</option>
                                        <option value="Pengadaan Barang dan Jasa (Berkala)">Pengadaan Barang dan Jasa (Berkala)</option>
                                        <option value="Standar Pelayanan (Berkala)">Standar Pelayanan (Berkala)</option>
                                        <option value="Maklumat Pelayanan (Berkala)">Maklumat Pelayanan (Berkala)</option>
                                        <option value="Ringkasan Program Strategis LPP RRI (Berkala)">Ringkasan Program Strategis LPP RRI (Berkala)</option>
                                        <option value="Dokumen Surat Menyurat (Berkala)">Dokumen Surat Menyurat (Berkala)</option>
                                        <option value="Informasi Terkait Penanganan Covid-19 (Berkala)">Informasi Terkait Penanganan Covid-19 (Berkala)</option>
                                        <option value="Opini BPK RI atas Laporan Keuangan LPP RRI (Berkala)">Opini BPK RI atas Laporan Keuangan LPP RRI (Berkala)</option>
                                        <option value="Penyelenggaraan Satu Data Indonesia (Berkala)">Penyelenggaraan Satu Data Indonesia (Berkala)</option>
                                        <option value="Bintang Radio RRI Tingkat Nasional (Berkala)">Bintang Radio RRI Tingkat Nasional (Berkala)</option>
                                        <option value="Formulir Pendaftaran PTQ RRI ke-53 Tahun 2023 (Berkala)">Formulir Pendaftaran PTQ RRI ke-53 Tahun 2023 (Berkala)</option>
                                        <option value="Informasi Publik dalam Bahasa Isyarat Indonesia (BISINDO) (Berkala)">Informasi Publik dalam Bahasa Isyarat Indonesia (BISINDO) (Berkala)</option>
                                        <option value="LHKPN Kepala RRI Seluruh Indonesia (Berkala)">LHKPN Kepala RRI Seluruh Indonesia (Berkala)</option>
                                        <option value="Press Release (Berkala)">Press Release (Berkala)</option>
                                        <option value="Formulir Pendaftaran PTQ RRI ke-54 Tahun 2024 (Berkala)">Formulir Pendaftaran PTQ RRI ke-54 Tahun 2024 (Berkala)</option>
                                        <option value="Laporan Tahunan LPP RRI (Berkala)">Laporan Tahunan LPP RRI (Berkala)</option>
                                        <option value="Rencana Umum Pengadaan (Berkala)">Rencana Umum Pengadaan (Berkala)</option>
                                        <option value="Peraturan, Keputusan dan Kebijakan (Berkala)">Peraturan, Keputusan dan Kebijakan (Berkala)</option>
                                        <option value="Regulasi Pedoman Pengelolaan Informasi (Berkala)">Regulasi Pedoman Pengelolaan Informasi (Berkala)</option>
                                        <option value="Regulasi Pedoman Pengelolaan Administrasi (Berkala)">Regulasi Pedoman Pengelolaan Administrasi (Berkala)</option>
                                        <option value="Regulasi Pedoman Pengelolaan Personil (Berkala)">Regulasi Pedoman Pengelolaan Personil (Berkala)</option>
                                        <option value="Rancangan Peraturan (Berkala)">Rancangan Peraturan (Berkala)</option>
                                        <option value="Masukan dari Berbagai Pihak atas Peraturan, Keputusan atau Kebijakan (Berkala)">Masukan dari Berbagai Pihak atas Peraturan, Keputusan atau Kebijakan (Berkala)</option>
                                        <option value="Risalah Rapat dari Proses Pembentukan Peraturan, Keputusan atau Kebijakan (Berkala)">Risalah Rapat dari Proses Pembentukan Peraturan, Keputusan atau Kebijakan (Berkala)</option>
                                        <option value="Dokumen Rancangan Peraturan, Keputusan Kebijakan yang dibentuk (Berkala)">Dokumen Rancangan Peraturan, Keputusan Kebijakan yang dibentuk (Berkala)</option>
                                        <option value="Dokumen Penghargaan (Berkala)">Dokumen Penghargaan (Berkala)</option>
                                        <option value="LHKPN Dewas dan Direksi (Berkala)">LHKPN Dewas dan Direksi (Berkala)</option>
                                        <option value="Hasil Monitoring dan Evaluasi KIP (Berkala)">Hasil Monitoring dan Evaluasi KIP (Berkala)</option>
                                        <option value="Pedoman HUT LPP RRI 80th (Berkala)">Pedoman HUT LPP RRI 80th (Berkala)</option>
                                        <option value="Informasi yang Wajib Diumumkan Tanpa Penundaan (Serta Merta)">Informasi yang Wajib Diumumkan Tanpa Penundaan (Serta Merta)</option>
                                        <option value="Menyangkut Ancaman Terhadap Hajat Hidup Orang Banyak dan Ketertiban Umum (Serta Merta)">Menyangkut Ancaman Terhadap Hajat Hidup Orang Banyak dan Ketertiban Umum (Serta Merta)</option>
                                        <option value="Pasal 17 UU 14 Tahun 2008 (Dikecualikan)">Pasal 17 UU 14 Tahun 2008 (Dikecualikan)</option>
                                    </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- Hidden input kategori -->
                        <input type="hidden" id="kategori" name="kategori" value="-">

                        <!-- Aktifkan kembali select kategori
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Kategori</label>
                            <div class="relative w-full">
                                <select name="kategori" class="w-full border rounded px-3 py-2 text-gray-500 appearance-none" required>
                                    <option value="-">-</option>                                
                                    <option value="PPID">PPID</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div> -->

                        <!-- Indeks -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Indeks</label>
                            <input type="text" name="indeks" class="w-full border rounded px-3 py-2">
                        </div>

                        <!-- Uraian Informasi -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Uraian Informasi</label>
                            <textarea name="uraian_informasi" class="w-full border rounded px-3 py-2"></textarea>
                        </div>

                        <!-- Tanggal -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Tanggal</label>
                            <input type="date" name="tanggal" class="w-full border rounded px-3 py-2 text-gray-500">
                        </div>

                        <!-- Tingkat Perkembangan -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Tingkat Perkembangan</label>
                            <div class="relative w-full">
                                <select name="tingkat_perkembangan" class="w-full border rounded px-3 py-2 text-gray-500 appearance-none" required>
                                    <option value="Asli">Asli</option>
                                    <option value="Fotocopy">Fotocopy</option>
                                    <option value="Asli & Fotocopy">Asli & Fotocopy</option>
                                    <option value="Softcopy">Softcopy</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- Jumlah -->
                        <div class="w-full max-w-2xl">
                            <label class="font-medium mb-1 block">Jumlah</label>
                            <div class="flex items-center gap-3">
                                
                                <!-- Input jumlah -->
                                <input 
                                    type="number" 
                                    name="jumlah" 
                                    min="0" 
                                    class="w-32 border rounded px-3 py-2 text-center" 
                                    placeholder="0"
                                >

                                <!-- Select + icon dropdown -->
                                <div class="relative w-40">
                                    <select 
                                        name="satuan" 
                                        class="w-full border rounded px-3 py-2 text-center text-gray-500 appearance-none" 
                                        required
                                    >
                                        <option value="lembar">Lembar</option>
                                        <option value="jilid">Jilid</option>
                                        <option value="bundle">Bundle</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">
                                        ▼
                                    </div>
                                </div>

                            </div>
                        </div>



                        <!-- SKKAAD
                        <div class="flex items-center">
                            <label class="w-48 font-medium">SKKAAD :</label>
                            <div class="relative">
                            <select name="skkaad" class="w-96 border rounded px-3 py-2 appearance-none text-gray-500" required>
                                <option value="">-</option>
                                <option value="Terbatas">Terbatas</option>
                                <option value="Biasa">Biasa</option>
                                <option value="Rahasia">Rahasia</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div> -->

                        <!-- Unit Pengolah Arsip -->
                        <div class="w-full max-w-2xl">
                            <label class="font-medium mb-1 block">Unit Pengolah Arsip</label>
                            <input 
                                type="text" 
                                value="TMB" 
                                class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700" 
                                readonly
                            >
                            <input type="hidden" name="unit_pengolah_id" value="{{ $unitTmb->id }}">
                        </div>
                    </div>
                </div>

                <!-- Form Lokasi Arsip -->
                <div class="bg-white p-6 rounded shadow mt-6">
                    <h2 class="font-semibold text-lg text-[#003B69] mb-4">Lokasi Arsip</h2>
                    <div class="space-y-4">

                        <!-- Ruangan -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Ruangan</label>
                            <input type="text" name="ruangan" class="w-full border rounded px-3 py-2">
                        </div>

                        <!-- No Box -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">No Box</label>
                            <input type="text" name="no_box" class="w-full border rounded px-3 py-2">
                        </div>

                        <!-- No Filling -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">No Filling</label>
                            <input type="text" name="no_filling" class="w-full border rounded px-3 py-2">
                        </div>

                        <!-- No Laci -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">No Laci</label>
                            <input type="text" name="no_laci" class="w-full border rounded px-3 py-2">
                        </div>

                        <!-- No Folder -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">No Folder</label>
                            <input type="text" name="no_folder" class="w-full border rounded px-3 py-2">
                        </div>

                        <!-- Keterangan -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Keterangan</label>
                            <textarea name="keterangan" class="w-full border rounded px-3 py-2"></textarea>
                        </div>

                        <!-- Upload Dokumen -->
                        <div class="w-full max-w-5xl">
                            <label class="font-medium mb-1 block">Upload Dokumen</label>
                            <input type="file" name="upload_dokumen" class="w-full border rounded px-3 py-2">
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
    <script>
    document.querySelector("form").addEventListener("submit", function(e) {
        let kategori = document.querySelector("select[name='kategori']").value;
        let kode = document.querySelector("select[name='kode_klasifikasi']").value;
        let tingkat = document.querySelector("select[name='tingkat_perkembangan']").value;
        let satuan = document.querySelector("select[name='satuan']").value;

        if (kategori === "" || kategori === "- Pilih Kategori -") {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kategori harus dipilih!',
                confirmButtonColor: '#003B69'
            });
            return;
        }

        if (kode === "" || kode === "-") {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kode klasifikasi harus dipilih!',
                confirmButtonColor: '#003B69'
            });
            return;
        }

        if (tingkat === "-" || tingkat === "") {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tingkat perkembangan harus dipilih!',
                confirmButtonColor: '#003B69'
            });
            return;
        }

        if (satuan === "-" || satuan === "") {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Satuan harus dipilih!',
                confirmButtonColor: '#003B69'
            });
            return;
        }
    });
    </script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kategori_berita').select2({
            
        });
    });
</script>

<script>
document.getElementById('kategori_berita').addEventListener('change', function () {
    let val = this.value;
    let kategoriInput = document.getElementById('kategori');

    kategoriInput.value = (val === '-') ? '-' : 'PPID';

    console.log("Kategori Berita:", val, "=> Kategori:", kategoriInput.value);
});
</script>

<script>
    $(document).ready(function() {
        // kategori_berita pakai select2
        $('#kategori_berita').select2();

        // kode_klasifikasi juga pakai select2
        $('#kode_klasifikasi').select2();
    });
</script>



</body>
</html>
