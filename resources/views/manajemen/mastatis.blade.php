<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANAJEMEN - SIPANDU</title>
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

            <a href="{{ url('/mastatis') }}"
               class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/laporanarsip') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/unit.png" alt="" class="w-6 h-6 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Laporan Arsip Unit</span>
            </a>

            <a href="{{ url('/laporanlayanan') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/publik.png" alt="" class="w-6 h-6 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Laporan Arsip Publik</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded [letter-spacing:1px]">
                Manajemen
            </div>
            <button class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded [letter-spacing:1px] rounded hover:bg-gray-300">
                <img src="/images/user.png" alt="User" class="w-5 h-5">
                <span>Log Out</span>
            </button>
        </header>

            <!-- Content -->
            <main class="p-6 space-y-6">
            <!-- Bagian atas: Pencarian + Total Arsip -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Statistik Arsip</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Pencarian -->
                <div class="bg-white p-4 rounded shadow md:col-span-2">
                    <h2 class="font-semibold text-lg mb-3">Pencarian</h2>
                    <div class="space-y-3">
                        <div class="h-5 bg-gray-200 rounded"></div>
                        <div class="h-5 bg-gray-200 rounded"></div>
                    </div>
                </div>

                <!-- Total Arsip -->
                <div class="bg-white p-4 rounded shadow flex flex-col items-center justify-center">
                    <h2 class="font-semibold text-lg mb-2">Total Arsip</h2>
                    <div class="bg-[#E3E8EE] px-11 py-4 rounded shadow-inner">
                        <p class="text-3xl font-bold text-gray-800">100</p>
                    </div>
                </div>

                <!-- Total Arsip Publik -->
                <div class="bg-white p-4 rounded shadow flex flex-col items-center justify-center">
                    <h2 class="font-semibold text-lg mb-2">Total Arsip Publik</h2>
                    <div class="bg-[#E3E8EE] px-11 py-4 rounded shadow-inner">
                        <p class="text-3xl font-bold text-gray-800">100</p>
                    </div>
                </div>
            </div>
            </div>

            

            <!-- Bagian bawah: Statistik Arsip -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Statistik Arsip -->
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold text-center mb-3">Statistik Arsip</h2>
                    <div class="h-64 flex items-center justify-center text-gray-400">
                        <p>[Grafik Arsip Dummy]</p>
                    </div>
                </div>

                <!-- Statistik Arsip Publik -->
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold text-center mb-3">Statistik Arsip Publik</h2>
                    <div class="h-64 flex items-center justify-center text-gray-400">
                        <p>[Grafik Arsip Publik Dummy]</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
