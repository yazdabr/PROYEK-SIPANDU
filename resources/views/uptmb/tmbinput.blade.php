<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Pengelola - SIPANDU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
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

            <a href="{{ url('/tmbdashboard') }}" class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('tmb.create') }}" class="group flex items-center space-x-2 p-3 rounded bg-[#CBD2DA] text-[#003B69] font-semibold">
                <img src="/images/inputbiru.png" class="w-7 h-7">
                <span>Input Arsip</span>
            </a>

            <a href="{{ route('tmb.index') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] font-semibold">
                <img src="/images/daftar.png" class="w-7 h-7">
                <span>Daftar Arsip Unit</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded">
                Unit Pengolah TMB
            </div>
            <button class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                <img src="/images/user.png" class="w-5 h-5">
                <span>Log Out</span>
            </button>
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
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Nama Berkas :</label>
                            <input type="text" name="judul" class="flex-1 border rounded px-3 py-2" required>
                        </div>

                        <!-- Nomor Berkas -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Nomor Berkas :</label>
                            <input type="text" name="nomor" class="flex-1 border rounded px-3 py-2">
                        </div>

                        <!-- Kode Klasifikasi -->
                        <div class="flex items-center">
                        <label class="w-48 font-medium">Kode Klasifikasi :</label>
                            <div class="relative">
                                <select name="kode_klasifikasi" class="w-96 border rounded px-3 py-2 appearance-none text-gray-500" required>
                                    <option value="">-</option>
                                    @foreach($kodeKlasifikasi as $kode)
                                        <option value="{{ $kode->id }}">{{ $kode->kode }} - {{ $kode->uraian }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Kategori :</label>
                            <div class="relative">
                            <select name="kategori" class="w-96 border rounded px-3 py-2 text-gray-500 appearance-none" required>
                                <option value="-">-</option>                                
                                <option value="PPID">PPID</option>

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
                            <select name="tingkat_perkembangan" class="w-96 border rounded px-3 py-2 text-gray-500 appearance-none" required>
                                <option value="">-</option>
                                <option value="Asli">Asli</option>
                                <option value="Fotocopy">Fotocopy</option>
                                <option value="Asli & Fotocopy">Asli & Fotocopy</option>
                                <option value="Softcopy">Softcopy</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- Jumlah -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Jumlah :</label>
                            <div class="relative">
                            <input type="number" name="jumlah" min="0" class="w-40 border rounded px-3 py-2 text-center" placeholder="0">
                            <select name="satuan" class="ml-3 w-32 border rounded px-3 py-2 text-center text-gray-500 appearance-none" required>
                                <option value="lembar">Lembar</option>
                                <option value="jilid">Jilid</option>
                                <option value="bundle">Bundle</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                            </div>
                        </div>

                        <!-- SKKAAD -->
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
                        </div>

                        <!-- Unit Pengolah Arsip -->
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Unit Pengolah Arsip :</label>
                            <input type="text" value="TMB" class="w-96 border rounded px-3 py-2 bg-gray-100 text-gray-700" readonly>
                            <input type="hidden" name="unit_pengolah_id" value="{{ $unitTmb->id }}">
                        </div>

                    </div>
                </div>

                <!-- Form Lokasi Arsip -->
                <div class="bg-white p-6 rounded shadow mt-6">
                    <h2 class="font-semibold text-lg text-[#003B69] mb-4">Lokasi Arsip</h2>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Ruangan :</label>
                            <input type="text" name="ruangan" class="w-96 border rounded px-3 py-2">
                        </div>
                        <div class="flex items-center">
                            <label class="w-48 font-medium">No Box :</label>
                            <input type="text" name="no_box" class="w-96 border rounded px-3 py-2">
                        </div>
                        <div class="flex items-center">
                            <label class="w-48 font-medium">No Filling :</label>
                            <input type="text" name="no_filling" class="w-96 border rounded px-3 py-2">
                        </div>
                        <div class="flex items-center">
                            <label class="w-48 font-medium">No Laci :</label>
                            <input type="text" name="no_laci" class="w-96 border rounded px-3 py-2">
                        </div>
                        <div class="flex items-center">
                            <label class="w-48 font-medium">No Folder :</label>
                            <input type="text" name="no_folder" class="w-96 border rounded px-3 py-2">
                        </div>
                        <div class="flex items-start">
                            <label class="w-48 font-medium pt-2">Keterangan :</label>
                            <textarea name="keterangan" class="flex-1 border rounded px-3 py-2"></textarea>
                        </div>
                        <div class="flex items-center">
                            <label class="w-48 font-medium">Upload Dokumen :</label>
                            <input type="file" name="upload_dokumen" class="w-96 border rounded px-3 py-2">
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-3 mt-4">
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
</body>
</html>
