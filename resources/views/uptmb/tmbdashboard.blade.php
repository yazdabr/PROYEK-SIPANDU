<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unit Pengolah TMB - PORTAL DATA TERPADU</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    /* Custom CSS untuk transisi max-height */
    .transition-max-height {
        transition-property: max-height;
    }
    
    /* Override untuk memastikan sidebar di desktop memiliki tinggi penuh */
    @media (min-width: 1024px) {
        .lg\:h-screen {
            height: 100vh;
        }
    }
    [x-cloak] { display: none !important; }
</style>
</head>

<body class="flex bg-[#EDF2F9]" x-data="layout">

    <!-- Sidebar -->
    <aside 
        id="sidebar"
        x-cloak
        class="fixed inset-y-0 left-0 z-50 w-64 bg-[#8E9BAB] text-white flex flex-col 
            transition-transform duration-300 transform 
            lg:translate-x-0 lg:min-h-screen overflow-y-auto"
        :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }"
    >
        <!-- Logo -->
        <div class="px-3 py-2 bg-[#68778B] flex items-center sticky top-0 z-10 shadow-md">
            <img src="/images/logo.png" class="h-16">
            <button @click="sidebarOpen = false" class="lg:hidden ml-auto p-2 text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4 space-y-2">
            <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">
                Selamat Datang
            </div>
            <a href="{{ url('/uptmb/tmbdashboard') }}" class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>
            <a href="{{ url('/uptmb/tmbinput') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/input.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Input Arsip</span>
            </a>
            <a href="{{ url('/uptmb/tmb') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold ">
                <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Unit</span>
            </a>
        </nav>

        <!-- Logout (hanya mobile) -->
        <form action="{{ route('logout') }}" method="POST" class="p-4 mt-auto lg:hidden">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-400 transition-all duration-200">
                <img src="/images/user.png" class="w-5 h-5" alt="user">
                <span>Log Out</span>
            </button>
        </form>
    </aside>


    <!-- Overlay (mobile) -->
    <div 
        x-show="sidebarOpen" 
        @click="sidebarOpen = false" 
        x-cloak
        class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"
        x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200"
    ></div>

    <div class="flex-1 flex flex-col lg:ml-64">
        <header class="flex items-center bg-[#E3E8EE] px-6 py-4 sticky top-0 z-30 shadow-md">
            <!-- Tombol buka sidebar (mobile) -->
            <button @click="sidebarOpen = true" class="lg:hidden p-2 text-[#003B69] hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Unit Pengolah TMB -->
            <div class="ml-auto lg:ml-0 px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded">
                Unit Pengolah TMB
            </div>

            <!-- Logout hanya muncul di desktop -->
            <form action="{{ route('logout') }}" method="POST" class="hidden lg:flex ml-auto">
                @csrf
                <button type="submit" class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-400 transition-all duration-200">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </form>
        </header>

        <main class="p-6 space-y-6">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Statistik Arsip</h2>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="bg-[#F9FAFB] p-6 rounded-lg shadow text-center">
                        <h3 class="font-semibold text-gray-600 mb-2">Total Arsip Unit</h3>
                        <p class="text-3xl font-bold text-[#003B69]">{{ $totalArsipUnit }}</p>
                    </div>
                    <div class="bg-[#F9FAFB] p-6 rounded-lg shadow text-center">
                        <h3 class="font-semibold text-gray-600 mb-2">Total Arsip PPID</h3>
                        <p class="text-3xl font-bold text-[#003B69]">{{ $totalArsipPPID }}</p>
                    </div>
                    <div class="bg-[#F9FAFB] p-6 rounded-lg shadow text-center">
                        <h3 class="font-semibold text-gray-600 mb-2">Total Arsip Belum Verif</h3>
                        <p class="text-3xl font-bold text-red-600">{{ $totalBelumVerif }}</p>
                    </div>
                    <div class="bg-[#F9FAFB] p-6 rounded-lg shadow text-center">
                        <h3 class="font-semibold text-gray-600 mb-2">Total Arsip Sudah Verif</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $totalSudahVerif }}</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


</body>
</html>