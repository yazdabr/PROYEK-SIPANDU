<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Pengolah KMB - PORTAL DATA TERPADU</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .select2-selection__clear { display: none !important; }
        .select2-selection__arrow { display: none !important; }
        .select2-container .select2-selection--single { height: 45px !important; line-height: 45px !important; font-size: 16px; }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px !important; padding-left: 10px !important;
        }
        @media (min-width: 1024px) { #sidebar { transform: translateX(0) !important; } }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="flex bg-[#EDF2F9]" x-data="layout">

<!-- Sidebar -->
<aside id="sidebar"
    x-cloak
    class="fixed inset-y-0 left-0 z-50 w-64 bg-[#8E9BAB] text-white flex flex-col 
           transition-transform duration-300 transform 
           lg:translate-x-0 lg:min-h-screen overflow-y-auto"
    :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }"
>
    <div class="px-3 py-2 bg-[#68778B] flex items-center sticky top-0 z-10 shadow-md">
        <img src="/images/logo.png" class="h-16">
        <button @click="sidebarOpen = false" class="lg:hidden ml-auto p-2 text-white hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">
            Selamat Datang
        </div>
        <a href="{{ url('/upkmb/kmbdashboard') }}" class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition">
            <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
            <span>Dashboard</span>
        </a>
        <a href="{{ url('/upkmb/kmbinput') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] font-semibold text-[#003B69]">
            <img src="/images/inputbiru.png" alt="" class="w-7 h-7 transition-transform group-hover:scale-110">
            <span class="group-hover:translate-x-1">Input Arsip</span>
        </a>
        <a href="{{ url('/upkmb/kmb') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] font-semibold">
            <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform group-hover:scale-110">
            <span class="group-hover:translate-x-1">Daftar Arsip Unit</span>
        </a>
    </nav>

    <form action="{{ route('logout') }}" method="POST" class="p-4 mt-auto lg:hidden">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-400">
            <img src="/images/user.png" class="w-5 h-5" alt="user">
            <span>Log Out</span>
        </button>
    </form>
</aside>

<!-- Overlay -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak
    class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>

<div class="flex-1 flex flex-col lg:ml-64">
<header class="flex items-center bg-[#E3E8EE] px-6 py-4 sticky top-0 z-30 shadow-md">
    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-[#003B69] hover:text-gray-600">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <div class="ml-auto lg:ml-0 px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded">
        Unit Pengolah KMB
    </div>
    <form action="{{ route('logout') }}" method="POST" class="hidden lg:flex ml-auto">
        @csrf
        <button type="submit" class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-400">
            <img src="/images/user.png" class="w-5 h-5" alt="user">
            <span>Log Out</span>
        </button>
    </form>
</header>

<main class="p-4 sm:p-6 space-y-6">
    <form action="{{ route('kmb.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white p-4 sm:p-6 rounded shadow">
            <h2 class="font-bold text-xl text-[#003B69] mb-4">Input Arsip</h2>
            <div class="space-y-4">
                {{-- Judul --}}
                <div>
                    <label class="font-medium mb-1 block">Judul</label>
                    <input type="text" name="judul" class="w-full border rounded px-3 py-2" required>
                </div>

                {{-- Nomor --}}
                <div>
                    <label class="font-medium mb-1 block">Nomor</label>
                    <input type="text" name="nomor" class="w-full border rounded px-3 py-2">
                </div>

                {{-- Kode Klasifikasi --}}
                <div>
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

                {{-- Kategori --}}
                <div>
                    <label class="font-medium mb-1 block">Kategori</label>
                    <div class="relative w-full">
                    <select id="kategori_berita" name="kategori_berita" class="w-full border rounded px-3 py-2 text-gray-500">
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
                <input type="hidden" id="kategori" name="kategori" value="-">

                {{-- Indeks --}}
                <div>
                    <label class="font-medium mb-1 block">Indeks</label>
                    <input type="text" name="indeks" class="w-full border rounded px-3 py-2">
                </div>

                {{-- Uraian --}}
                <div>
                    <label class="font-medium mb-1 block">Uraian Informasi</label>
                    <textarea name="uraian_informasi" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="font-medium mb-1 block">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border rounded px-3 py-2 text-gray-500">
                </div>

                {{-- Tingkat Perkembangan --}}
                <div>
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

                {{-- Jumlah --}}
                <div>
                    <label class="font-medium mb-1 block">Jumlah</label>
                    <div class="flex gap-3">
                        <input type="number" name="jumlah" min="0" class="w-32 border rounded px-3 py-2 text-center" placeholder="0">
                        <div class="relative w-full sm:w-40">
                        <select name="satuan" class="w-40 border rounded px-3 py-2 text-gray-500 appearance-none" required>
                            <option value="lembar">Lembar</option>
                            <option value="jilid">Jilid</option>
                            <option value="bundle">Bundle</option>
                        </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                        </div>
                    </div>
                </div>

                {{-- Unit Pengolah --}}
                <div>
                    <label class="font-medium mb-1 block">Unit Pengolah Arsip</label>
                    <input type="text" value="KMB" class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700" readonly>
                    <input type="hidden" name="unit_pengolah_id" value="{{ $unitKmb->id }}">
                </div>
            </div>
        </div>

                <div class="bg-white p-4 sm:p-6 rounded shadow mt-6">
                    <h2 class="font-semibold text-xl text-[#003B69] mb-4">Lokasi Arsip</h2>
                    <div class="space-y-4">

                        <div class="w-full">
                            <label class="font-medium mb-1 block">Ruangan</label>
                            <input type="text" name="ruangan" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="w-full">
                            <label class="font-medium mb-1 block">No Box</label>
                            <input type="text" name="no_box" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="w-full">
                            <label class="font-medium mb-1 block">No Filling</label>
                            <input type="text" name="no_filling" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="w-full">
                            <label class="font-medium mb-1 block">No Laci</label>
                            <input type="text" name="no_laci" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="w-full">
                            <label class="font-medium mb-1 block">No Folder</label>
                            <input type="text" name="no_folder" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="w-full">
                            <label class="font-medium mb-1 block">Keterangan</label>
                            <textarea name="keterangan" class="w-full border rounded px-3 py-2"></textarea>
                        </div>

                        <div class="w-full">
                            <label class="font-medium mb-1 block">Upload Dokumen</label>
                            <input type="file" name="upload_dokumen" class="w-full border rounded px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-[#003B69] hover:file:bg-gray-100">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-8">
                        <a href="{{ route('tmb.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded shadow hover:bg-gray-500 transition-colors duration-300">Kembali</a>
                        <button type="submit" class="bg-[#003B69] text-white px-4 py-2 rounded shadow hover:bg-blue-900 transition-colors duration-300">Simpan</button>
                    </div>
    </form>
</main>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // === Logika Form Validation ===
        document.querySelector("form").addEventListener("submit", function(e) {
            let kategori = document.getElementById('kategori_berita').value; 
            let kode = document.getElementById('kode_klasifikasi').value;
            let tingkat = document.querySelector("select[name='tingkat_perkembangan']").value;
            let satuan = document.querySelector("select[name='satuan']").value;

            if (kategori === "" || kategori === "-") {
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

        // === Inisialisasi Select2 dan Logika Kategori ===
        $(document).ready(function() {
            // Inisialisasi Select2
            $('#kategori_berita').select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
            $('#kode_klasifikasi').select2({
                dropdownAutoWidth: true,
                width: '100%' // Ini seharusnya bekerja
            });

            // Set nilai awal kategori hidden input
            let initialVal = document.getElementById('kategori_berita').value;
            document.getElementById('kategori').value = (initialVal === '-') ? '-' : 'PPID';
        });

        // Update Kategori Hidden Input saat Select Berubah
        document.getElementById('kategori_berita').addEventListener('change', function () {
            let val = this.value;
            let kategoriInput = document.getElementById('kategori');
            kategoriInput.value = (val === '-') ? '-' : 'PPID';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('layout', () => ({
            sidebarOpen: window.innerWidth >= 1024, // default: buka kalau desktop
            init() {
                window.addEventListener('resize', () => {
                    this.sidebarOpen = window.innerWidth >= 1024;
                });
            }
        }))
    })
</script>
</body>
</html>
