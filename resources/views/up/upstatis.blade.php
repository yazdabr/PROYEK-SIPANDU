<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Pengelola - SIPANDU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex min-h-screen bg-[#EDF2F9]">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#8E9BAB] text-white flex flex-col" 
           x-data="{ openPemberkasan: false, submenus: ['Menu Baru 1','Menu Baru 2'] }">

        <div class="px-3 py-2 bg-[#68778B] flex items-center">
            <img src="/images/logo.png" class="h-16">
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">
                Selamat Datang
            </div>

            <!-- Menu langsung tampil -->
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
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Unit</span>
            </a>

            <!-- <a href="#"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out">
                <img src="/images/panahputih.png" alt="" class="w-4 h-4 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Pemberkasan Arsip</span>
            </a>

            <a href="#"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out">
                <img src="/images/panahputih.png" alt="" class="w-4 h-4 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Pencarian Arsip Unit</span>
            </a>

            <a href="#"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out">
                <img src="/images/panahputih.png" alt="" class="w-4 h-4 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Laporan Arsip Unit</span>
            </a> -->
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded [letter-spacing:1px]">
                Unit Pengolah
            </div>
            <button class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                <img src="/images/user.png" alt="User" class="w-5 h-5">
                <span>Log Out</span>
            </button>
        </header>

        <!-- Content -->
        <main class="p-6 space-y-6">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Statistik Arsip</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pencarian -->
                    <div class="bg-white p-4 rounded shadow">
                        <h2 class="font-semibold text-lg mb-3">Pencarian</h2>
                        <div class="space-y-3">
                            <div class="h-5 bg-gray-200 rounded"></div>
                            <div class="h-5 bg-gray-200 rounded"></div>
                            <div class="h-5 bg-gray-200 rounded"></div>
                        </div>
                    </div>

                    <!-- Total Arsip Unit -->
                    <div class="bg-white p-4 rounded shadow flex flex-col justify-center items-center">
                        <h2 class="font-semibold text-lg mb-2">Total Arsip Unit</h2>
                        <p class="text-3xl font-bold text-gray-800">1,024</p>
                    </div>
                </div>
            </div>



            <!-- Statistik Arsip Unit -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-semibold text-center mb-3">Grapik Arsip Unit</h2>
                <div class="h-64 flex items-center justify-center text-gray-400">
                    <p>[Grafik Dummy]</p>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
