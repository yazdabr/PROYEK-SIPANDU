<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unit Pengolah - SIPANDU</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col md:flex-row min-h-screen bg-[#EDF2F9]">

<!-- Sidebar -->
<aside class="w-full md:w-64 bg-[#8E9BAB] text-white flex flex-col md:h-screen">
    <div class="px-3 py-2 bg-[#68778B] flex items-center justify-between md:justify-start">
        <img src="/images/logo.png" class="h-16" alt="Logo">
        <!-- Tombol toggle untuk mobile -->
        <button class="md:hidden text-white focus:outline-none" onclick="toggleSidebar()">
            ☰
        </button>
    </div>

    <!-- Wrapper untuk animasi max-height -->
    <div id="navWrapper" class="overflow-hidden transition-max-height duration-500 ease-in-out max-h-0 md:max-h-full">
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

            <a href="{{ url('/uptmb/tmb') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Unit</span>
            </a>
        </nav>
    </div>
</aside>

<!-- Main Content -->
<div class="flex-1 flex flex-col">
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-center bg-[#E3E8EE] px-6 py-4 space-y-3 md:space-y-0">
        <div class="flex justify-between items-center w-full md:w-auto">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded">
                Unit Pengolah TMB
            </div>

            <!-- Tombol Logout hanya sejajar di mobile -->
            <form action="{{ route('logout') }}" method="POST" class="md:hidden ml-4">
                @csrf
                <button type="submit" class="flex items-center justify-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </form>
        </div>

        <!-- Tombol Logout normal di desktop -->
        <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
            @csrf
            <button type="submit" class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                <img src="/images/user.png" class="w-5 h-5" alt="user">
                <span>Log Out</span>
            </button>
        </form>
    </header>

    <!-- Content -->
    <main class="p-6 space-y-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="font-bold text-lg text-[#003B69] mb-4">Statistik Arsip</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-6">
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
function toggleSidebar() {
    const navWrapper = document.getElementById('navWrapper');
    if (navWrapper.style.maxHeight && navWrapper.style.maxHeight !== '0px') {
        navWrapper.style.maxHeight = '0';
    } else {
        navWrapper.style.maxHeight = navWrapper.scrollHeight + 'px';
    }
}
</script>

</body>
</html>
