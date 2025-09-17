<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAFTAR ARSIP PUBLIK - SIPANDU</title>
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
                   {icon: '/images/panahputih.png', text: 'Statistik Arsip', route: '{{ url('/ppidstatis') }}'},
                   {icon: '/images/panahputih.png', text: 'Verifikasi', route: '{{ url('/verifikasi') }}'},
                   {icon: '/images/panahbiru.png', text: 'Daftar Arsip Publik', route: '{{ url('/dap') }}'},
                   {icon: '/images/panahputih.png', text: 'Pemberkasan Arsip'},
                   {icon: '/images/panahputih.png', text: 'Pencarian Arsip Unit'},
                   {icon: '/images/panahputih.png', text: 'Laporan Arsip Unit'}
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
                    :class="menu.text === 'Daftar Arsip Publik' ? 'text-[#003B69] font-semibold' : 'text-white'">

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
                Operator PPID
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
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Daftar Arsip Publik</h2>
                
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
