<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Pengelola - SIPANDU</title>
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
                   {icon: '/images/panahputih.png', text: 'Statistik Arsip', route: '{{ url('/upstatis') }}'},
                   {icon: '/images/panahbiru.png', text: 'Input Arsip', route: '{{ url('/input') }}'},
                   {icon: '/images/panahputih.png', text: 'Daftar Arsip Unit', route: '{{ url('/dau') }}'},
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
                    :class="menu.text === 'Input Arsip' ? 'text-[#003B69] font-semibold' : 'text-white'">
                    
                        <img :src="menu.icon" alt="" 
                            class="w-4 h-4 transition-transform duration-300 ease-in-out group-hover:scale-110">
                        
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
                Unit Pengolah
            </div>
            <button class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded [letter-spacing:1px] rounded hover:bg-gray-300">
                <img src="/images/user.png" alt="User" class="w-5 h-5">
                <span>Log Out</span>
            </button>
        </header>

        <!-- Content -->
        <main class="p-6 space-y-6">
            <!-- Form Input Arsip -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-semibold text-lg text-[#003B69] mb-4">Input Arsip</h2>

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
                            <!-- Icon panah custom -->
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">
                                ▼
                            </div>
                        </div>
                    </div>

                    <!-- Kode Klasifikasi -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Kode Klasifikasi :</label>
                        <input type="text" class="w-96 border rounded px-3 py-2">
                    </div>

                    <!-- Indeks -->
                    <div class="flex items-center">
                        <label class="w-48 font-medium">Indeks :</label>
                        <input type="text" class="w-96 flex border rounded px-3 py-2">
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
                        <div class="relative">
                            <select class="w-96 border rounded px-3 py-2 appearance-none pr-8">
                                <option>-</option>
                                <option>PPID</option>
                            </select>
                            <!-- Icon panah custom -->
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">
                                ▼
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah -->
                    <div class="flex items-center space-x-2">
                        <label class="w-48 font-medium">Jumlah :</label>
                        <!-- Input angka -->
                        <input 
                            type="number" 
                            class="w-40 border rounded px-3 py-2 text-center appearance-none" 
                            placeholder="0">
                        
                        <!-- Input lembar -->
                        <input 
                            type="text" 
                            class="w-32 border rounded px-3 py-2 text-center" 
                            placeholder="lembar">
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

                <!-- Tombol -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">Kembali</button>
                    <button class="px-4 py-2 bg-[#68778B] text-white rounded hover:bg-[#566372] transition">Simpan</button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
