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
    <aside class="w-64 bg-[#8E9BAB] text-white flex flex-col" 
           x-data="{ 
               open: false, 
               menus: [
                {icon: '/images/panahbiru.png', text: 'Statistik Arsip', route: '{{ url('/mastatis') }}'},
                {icon: '/images/panahputih.png', text: 'Laporan Arsip', route: '{{ url('/laporanarsip') }}'},
                {icon: '/images/panahputih.png', text: 'Laporan Layanan Arsip Publik', route: '{{ url('/laporanlayanan') }}'}
               ]
           }">

        <div class="px-3 py-2 bg-[#68778B] flex items-center">
            <img src="/images/logo.png" class="h-16">
        </div>



        <nav class="flex-1 p-4 space-y-2">
            <!-- Dashboard dengan toggle -->
            <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">Navigation</div>

            <button @click="open = !open"
                class="flex items-center justify-between w-full p-5 rounded bg-[#68778B] hover:bg-gray-500">
                <div class="flex items-center space-x-2">
                    <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                    <span>Dashboard</span>
                </div>
                <svg :class="open ? 'rotate-90' : ''" 
                     class="w-4 h-4 transform transition-transform"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Submenu dengan stagger animasi -->
            <div class="ml-2 mt-2 space-y-2 p-1">
                <template x-for="(menu, i) in menus" :key="i">
                    <a :href="menu.route"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    :style="open 
                        ? `transition-delay: ${i * 100}ms` 
                        : `transition-delay: ${(menus.length - i) * 100}ms`"
                    class="group flex items-center space-x-2 p-2 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out"
                    :class="menu.text === 'Statistik Arsip' ? 'text-[#003B69] font-semibold' : 'text-white'">

                        <!-- Icon -->
                        <img :src="menu.icon" alt="" 
                            class="w-4 h-4 transition-transform duration-300 ease-in-out group-hover:scale-110">

                        <!-- Text -->
                        <span x-text="menu.text" 
                            class="transition-transform duration-300 ease-in-out group-hover:translate-x-1"></span>
                    </a>
                </template>
            </div>
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
