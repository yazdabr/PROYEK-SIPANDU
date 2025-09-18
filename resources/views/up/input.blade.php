<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Pengelola - SIPANDU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Alpine.js + collapse plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
</head>
<!-- Notifikasi -->
 @if(session('success'))
<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition 
    class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow-lg"
>
    {{ session('success') }}
    <button @click="show = false" class="ml-3 font-bold">✕</button>
</div>
@endif

<body class="flex min-h-screen bg-[#EDF2F9]">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#8E9BAB] text-white flex flex-col">
        <!-- Logo -->
        <div class="px-3 py-2 bg-[#68778B] flex items-center">
            <img src="/images/logo.png" class="h-16">
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2">
            <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">
                Selamat Datang
            </div>

            <a href="{{ url('/upstatis') }}"
               class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/input') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out text-[#003B69] font-semibold">
                <img src="/images/inputbiru.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Input Arsip</span>
            </a>

            <a href="{{ url('/dau') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Unit</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded [letter-spacing:1px]">
                Unit Pengolah
            </div>
            <button class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300 transition">
                <img src="/images/user.png" alt="User" class="w-5 h-5">
                <span>Log Out</span>
            </button>
        </header>

        <!-- Content -->
        <main class="p-6 space-y-6">
            <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Form Input Arsip -->
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="font-bold text-lg text-[#003B69] mb-4">Input Arsip</h2>
                    <div class="space-y-4">
                        <!-- Judul -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Nama Berkas :</label>
                            <input type="text" name="judul" class="flex-1 border rounded px-3 py-2" required>
                        </div>

                        <!-- Nomor -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Nomor :</label>
                            <input type="text" name="nomor" class="flex-1 border rounded px-3 py-2">
                        </div>

                        <!-- Kategori -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Kategori :</label>
                            <div class="relative">
                                <select name="kategori" class="w-96 border rounded text-gray-500 px-3 py-2 appearance-none pr-8">
                                    <option value="">- Pilih Kategori -</option>
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

                        <!-- Kode Klasifikasi -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Kode Klasifikasi :</label>
                            <div class="relative">
                                <select name="kode_klasifikasi" class="w-96 border rounded px-3 py-2 appearance-none pr-8">
                                    <option value="">-</option>
                                    @foreach($kodeklasifikasi as $kode)
                                        <option value="{{ $kode->kode }}">{{ $kode->kode }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>



                        <!-- Indeks -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Indeks :</label>
                            <input type="text" name="indeks" class="w-96 border rounded px-3 py-2">
                        </div>

                        <!-- Uraian Informasi -->
                        <div class="flex items-start">
                            <label class="w-48 font-medium pt-2">Uraian Informasi :</label>
                            <textarea name="uraian_informasi" class="flex-1 border rounded px-3 py-2"></textarea>
                        </div>

                        <!-- Tanggal -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Tanggal :</label>
                            <input type="date" name="tanggal" class="w-48 border rounded px-3 py-2 text-gray-500">
                        </div>

                        <!-- Tingkat Perkembangan -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Tingkat Perkembangan :</label>
                            <div class="relative">
                                <select name="tingkat_perkembangan" class="w-96 border rounded px-3 py-2 appearance-none pr-8">
                                    <option>-</option>
                                    <option>Asli</option>
                                    <option>Copy</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- Jumlah -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Jumlah :</label>
                            <input type="number" name="jumlah" min="0"
                                class="w-40 border rounded px-3 py-2 text-center appearance-none" placeholder="0">

                            <!-- Tambah margin kiri -->
                            <div class="relative ml-3">
                                <select name="satuan" class="w-32 border rounded text-gray-500 px-3 py-2 appearance-none pr-8 text-center" required>
                                    <option value="" disabled selected>Satuan</option>
                                    <option value="lembar">Lembar</option>
                                    <option value="jilid">Jilid</option>
                                    <option value="bundle">Bundle</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>


                        <!-- Unit Pengolah Arsip -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium appearance-none">Unit Pengolah Arsip :</label>
                            <div class="relative">
                                <select name="unit_pengolah_arsip" class="w-96 border rounded px-3 py-2 text-gray-500 appearance-none">
                                    <option value="TMB">TMB</option>
                                    <option value="SIARAN">SIARAN</option>
                                    <option value="KMB">KMB</option>
                                    <option value="LPU">LPU</option>
                                    <option value="TATA USAHA KEUANGAN">TATA USAHA KEUANGAN</option>
                                    <option value="TATA USAHA UMUM">TATA USAHA UMUM</option>
                                    <option value="TATA USAHA SDM">TATA USAHA SDM</option>
                                </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Form Lokasi Arsip -->
                <div class="bg-white p-6 rounded shadow mt-6">
                    <h2 class="font-semibold text-lg text-[#003B69] mb-4">Lokasi Arsip</h2>
                    <div class="space-y-4">
                        <!-- Ruangan -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Ruangan :</label>
                            <input type="text" name="ruangan" class="w-96 border rounded px-3 py-2">
                        </div>

                        <!-- No Filling -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">No Filling :</label>
                            <input type="text" name="no_filling" class="w-96 border rounded px-3 py-2">
                        </div>

                        <!-- No Laci -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">No Laci :</label>
                            <input type="text" name="no_laci" class="w-96 border rounded px-3 py-2">
                        </div>

                        <!-- No Folder -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">No Folder :</label>
                            <input type="text" name="no_folder" class="w-96 border rounded px-3 py-2">
                        </div>

                        <!-- Keterangan -->
                        <div class="flex items-start">
                            <label class="w-48 font-medium pt-2">Keterangan :</label>
                            <textarea name="keterangan" class="flex-1 border rounded px-3 py-2"></textarea>
                        </div>

                        <!-- Upload Dokumen -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Upload Dokumen :</label>
                            <input type="file" name="upload_dokumen" class="w-96 border rounded px-3 py-2">
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-3 mt-4">
                        <a href="{{ url('/upstatis') }}"
                            class="bg-gray-400 font-semibold text-white px-4 py-2 rounded shadow hover:bg-gray-500 transition">
                            Kembali
                        </a>
                        <button type="submit"
                            class="bg-[#003B69] text-white font-semibold px-4 py-2 rounded shadow hover:bg-blue-900 transition">
                            Simpan
                        </button>
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
</body>
</html>
