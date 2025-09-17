<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAFTAR ARSIP UNIT - SIPANDU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js + collapse plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
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
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/input.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Input Arsip</span>
            </a>

            <a href="{{ url('/dau') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out  text-[#003B69] font-semibold">
                <img src="/images/daftarbiru.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
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
            <button class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded [letter-spacing:1px] rounded hover:bg-gray-300">
                <img src="/images/user.png" alt="User" class="w-5 h-5">
                <span>Log Out</span>
            </button>
        </header>

        <!-- Content -->
        <main class="p-6 space-y-6">
            <!-- Judul -->
            <div class="bg-white p-5 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Daftar Arsip Unit</h2>
                
                <!-- Wrapper scroll -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">Kode Klasifikasi</th>
                                <th class="px-3 py-2 border">Indeks</th>
                                <th class="px-3 py-2 border">No Item Arsip</th>
                                <th class="px-3 py-2 border">Uraian Informasi</th>
                                <th class="px-3 py-2 border">Tanggal</th>
                                <th class="px-3 py-2 border">Jumlah</th>
                                <th class="px-3 py-2 border">Unit Pengolah Arsip</th>
                                <th class="px-3 py-2 border">Lokasi Arsip</th>
                                <th class="px-3 py-2 border">Ruangan</th>
                                <th class="px-3 py-2 border">No Filling</th>
                                <th class="px-3 py-2 border">No Laci</th>
                                <th class="px-3 py-2 border">No Folder</th>
                                <th class="px-3 py-2 border">Keterangan</th>
                                <th class="px-3 py-2 border">Arsip Digital (Link)</th>
                                <th class="px-3 py-2 border">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-3 py-2 border text-center">1</td>
                                <td class="px-3 py-2 border">A-001</td>
                                <td class="px-3 py-2 border">IDX-01</td>
                                <td class="px-3 py-2 border">001</td>
                                <td class="px-3 py-2 border">Contoh uraian arsip</td>
                                <td class="px-3 py-2 border">2025-09-12</td>
                                <td class="px-3 py-2 border text-center">2</td>
                                <td class="px-3 py-2 border">Unit A</td>
                                <td class="px-3 py-2 border">Rak 1</td>
                                <td class="px-3 py-2 border">Ruang 101</td>
                                <td class="px-3 py-2 border">F-001</td>
                                <td class="px-3 py-2 border">L-01</td>
                                <td class="px-3 py-2 border">FD-01</td>
                                <td class="px-3 py-2 border">Lengkap</td>
                                <td class="px-3 py-2 border text-blue-600 underline cursor-pointer">Link</td>
                                <td class="px-3 py-2 border">Rahasia</td>
                            </tr>
                            <!-- Tambahkan baris data lainnya di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
