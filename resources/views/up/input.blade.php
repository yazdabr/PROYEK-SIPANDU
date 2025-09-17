<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Pengelola - SIPANDU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
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

            <!-- Form Input Arsip -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Input Arsip</h2>
                <div class="space-y-4">
                    <!-- Judul -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Judul :</label>
                        <input type="text" class="flex-1 border rounded px-3 py-2">
                    </div>

                    <!-- Nomor -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Nomor :</label>
                        <input type="text" class="flex-1 border rounded px-3 py-2">
                    </div>

                    <!-- Kategori -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Kategori :</label>
                        <div class="relative">
                            <select class="w-96 border rounded px-3 py-2 appearance-none pr-8">
                                <option>-</option>
                                <option>PPID</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                        </div>
                    </div>

                    <!-- Kode Klasifikasi -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Kode Klasifikasi :</label>
                        <div class="relative">
                            <select class="w-96 border rounded px-3 py-2 appearance-none pr-8">
                                <option>-</option>
                                <option>PPID</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                        </div>
                    </div>

                    <!-- Indeks -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Indeks :</label>
                        <input type="text" class="w-96 border rounded px-3 py-2">
                    </div>

                    <!-- Uraian Informasi -->
                    <div class="flex items-start">
                        <label class="w-48 font-medium pt-2">Uraian Informasi :</label>
                        <textarea class="flex-1 border rounded px-3 py-2"></textarea>
                    </div>

                    <!-- Tanggal -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Tanggal :</label>
                        <input type="date" class="w-48 border rounded px-3 py-2">
                    </div>

                    <!-- Tingkat Perkembangan -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Tingkat Perkembangan :</label>
                        <input type="text" class="w-96 border rounded px-3 py-2">
                    </div>

                    <!-- Jumlah -->
                    <div class="flex items-center space-x-2">
                        <label class="w-48 font-medium">Jumlah :</label>
                        <input 
                            type="number" 
                            min="0"
                            class="w-40 border rounded px-3 py-2 text-center appearance-none" 
                            placeholder="0">
                        <div class="relative">
                            <select class="w-32 border rounded px-3 py-2 appearance-none pr-8 text-center">
                                <option>-</option>
                                <option>lembar</option>
                                <option>jilid</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                        </div>
                    </div>

                    <!-- Unit Pengolah Arsip -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Unit Pengolah Arsip :</label>
                        <input type="text" class="flex-1 border rounded px-3 py-2" placeholder="**muncul otomatis sesuai dengan user login**">
                    </div>
                </div>
            </div>

            <!-- Form Lokasi Arsip -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-semibold text-lg text-[#003B69] mb-4">Lokasi Arsip</h2>
                <div class="space-y-4">
                    <!-- Ruangan -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Ruangan :</label>
                        <input type="text" class="w-96 border rounded px-3 py-2">
                    </div>

                    <!-- No Filling -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">No Filling :</label>
                        <input type="text" class="w-96 border rounded px-3 py-2">
                    </div>

                    <!-- No Laci -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">No Laci :</label>
                        <input type="text" class="w-96 border rounded px-3 py-2">
                    </div>

                    <!-- No Folder -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">No Folder :</label>
                        <input type="text" class="w-96 border rounded px-3 py-2">
                    </div>

                    <!-- Keterangan -->
                    <div class="flex items-start">
                        <label class="w-48 font-medium pt-2">Keterangan :</label>
                        <textarea class="flex-1 border rounded px-3 py-2"></textarea>
                    </div>

                    <!-- Upload Dokumen -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Upload Dokumen :</label>
                        <input type="file" class="w-96 border rounded px-3 py-2">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ url('/upstatis') }}"
                    class="bg-gray-400 text-white px-4 py-2 rounded shadow hover:bg-gray-500 transition">
                        Kembali
                    </a>
                    <button type="submit"
                            class="bg-[#003B69] text-white px-4 py-2 rounded shadow hover:bg-blue-900 transition">
                        Simpan
                    </button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
