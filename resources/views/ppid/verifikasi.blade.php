<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator PPID - PORTAL DATA TERPADU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Custom CSS untuk transisi max-height */
        .transition-max-height {
            transition-property: max-height;
        }
        
        /* Mengatasi isian blade kosong agar alpinejs tidak error saat render */
        [x-cloak] { display: none !important; }

        /* Mengatur agar sidebar tetap di posisi dan konten utama bergeser */
        @media (min-width: 1024px) {
            .lg\:ml-64 {
                margin-left: 16rem; /* Sama dengan w-64 */
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
            <a href="{{ url('/ppid/ppidstatis') }}" class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>
            <a href="{{ url('/ppid/verifikasi') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold text-[#003B69]">
                <img src="/images/verifbiru.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Verifikasi</span>
            </a>
            <a href="{{ url('/ppid/dap') }}" class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Publik</span>
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
                Operator PPID
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


        <main class="p-4 sm:p-6 space-y-6">
            @if (session('success'))
                <div id="popupNotif" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 
                    bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <div id="popupNotif" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 
                    bg-yellow-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                    {{ session('warning') }}
                </div>
            @endif

            <div class="bg-white p-5 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Verifikasi</h2>
                <div x-data="{ showModal: false, selected: null }" class="overflow-x-auto">

                    <table class="min-w-full border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-3 py-2 border w-12">No</th>
                                <th class="px-3 py-2 border min-w-[200px]">Data</th>
                                <th class="px-3 py-2 border w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($arsip as $key => $item)
                            <tr id="row-{{ $item->id }}">
                                <td class="px-3 py-2 border text-center align-top">{{ $key + 1 }}</td>
                                <td class="px-3 py-2 border align-top">
                                    <div class="flex flex-col space-y-1">
                                        <div class="flex flex-col space-y-1 mb-2">
                                            <span><strong>Judul:</strong> {{ $item->judul }}</span>
                                            <span><strong>Nomor:</strong> {{ $item->nomor_arsip }}</span>
                                            <span><strong>Unit:</strong> {{ $item->unitPengolah->nama_unit ?? '-' }}</span>
                                        </div>
                                        <div class="gap-3 mt-2 flex flex-wrap items-center">
                                            <button 
                                                class="bg-gray-600 text-white px-2 py-1 text-xs rounded hover:bg-gray-400 transition font-semibold flex items-center"
                                                @click="showModal = true; selected = {
                                                    judul: '{{ $item->judul }}',
                                                    nomor: '{{ $item->nomor_arsip }}',
                                                    kategori_berita: '{{ $item->kategori_berita }}',
                                                    kategori: '{{ $item->kategori }}',
                                                    kode_klasifikasi: '{{ $item->kodeKlasifikasi->kode ?? '-' }}',
                                                    indeks: '{{ $item->indeks }}',
                                                    uraian_informasi: '{{ $item->uraian_informasi }}',
                                                    tanggal: '{{ $item->tanggal }}',
                                                    tingkat_perkembangan: '{{ $item->tingkat_perkembangan }}',
                                                    jumlah: '{{ $item->jumlah }}',
                                                    satuan: '{{ $item->satuan }}',
                                                    unit_pengolah_arsip: '{{ $item->unitPengolah->nama_unit ?? '-' }}',
                                                    ruangan: '{{ $item->ruangan }}',
                                                    no_box: '{{ $item->no_box }}',
                                                    no_filling: '{{ $item->no_filling }}',
                                                    no_laci: '{{ $item->no_laci }}',
                                                    no_folder: '{{ $item->no_folder }}',
                                                    keterangan: '{{ $item->keterangan }}',
                                                    skkaad: '{{ $item->skkaad }}',
                                                    upload_dokumen: '{{ $item->upload_dokumen }}'
                                                }">
                                                <img src="{{ asset('images/more.png') }}" alt="Detail" class="w-5 h-6 object-contain mr-1">
                                                Detail
                                            </button>
                                            @if ($item->upload_dokumen)
                                                <a href="{{ asset('storage/'.$item->upload_dokumen) }}" target="_blank" class="bg-[#7592BA] text-white px-2 py-2 text-xs rounded hover:bg-[#B4D0F6] transition font-semibold">
                                                    Lihat File
                                                </a>
                                            @else
                                                <span class="text-gray-500 text-xs">Tidak ada file</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
<td class="px-3 py-2 border align-middle"> 
    <div class="flex justify-center font-semibold">
        <div x-data="{ showVerifModal: false }">
            <button @click="showVerifModal = true" 
                    class="bg-[#7592BA] text-white px-4 py-2 text-xs rounded hover:bg-[#B4D0F6] transition font-semibold">
                Verifikasi
            </button>
            
            <div 
                x-show="showVerifModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
                x-cloak
            >
                <div 
                    x-show="showVerifModal"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 text-center"
                >
                    <h3 class="text-lg font-semibold mb-4">Apakah Data Termasuk Publik?</h3>

                    <div class="flex justify-center gap-4">
                        <form action="{{ route('verifikasi.publik', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-[#68778B] text-white px-4 py-2 rounded hover:bg-[#4A5A6B] transition font-semibold">
                                YA
                            </button>
                        </form>

                        <form action="{{ route('verifikasi.tidak', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                TIDAK
                            </button>
                        </form>
                    </div>

                    <button @click="showVerifModal = false" class="mt-4 text-gray-500 hover:text-gray-700 text-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>
</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-3 py-2 border text-center text-gray-500">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center px-4 z-50"
                        x-show="showModal"
                        x-cloak
                        x-transition:enter="transition transform ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-6"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition transform ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-6"
                        >
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto p-6 relative my-auto">
                            <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl" @click="showModal = false">&times;</button>
                            <h3 class="text-lg font-bold text-[#003B69] mb-4">Detail Arsip</h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full border border-gray-300 text-sm">
                                    <tbody>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">No Kode Klasifikasi</th><td class="px-3 py-2 border" x-text="selected?.kode_klasifikasi ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Kategori</th><td class="px-3 py-2 border" x-text="selected?.kategori_berita ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Data Publik/Tidak</th><td class="px-3 py-2 border" x-text="selected?.kategori ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Judul</th><td class="px-3 py-2 border" x-text="selected?.judul ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Nomor</th><td class="px-3 py-2 border" x-text="selected?.nomor ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Indeks</th><td class="px-3 py-2 border" x-text="selected?.indeks ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Uraian Informasi</th><td class="px-3 py-2 border" x-text="selected?.uraian_informasi ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Tanggal</th><td class="px-3 py-2 border" x-text="selected?.tanggal ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Tingkat Perkembangan</th><td class="px-3 py-2 border" x-text="selected?.tingkat_perkembangan ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Jumlah</th><td class="px-3 py-2 border" x-text="selected?.jumlah ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Satuan</th><td class="px-3 py-2 border" x-text="selected?.satuan ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Unit Pengolah Arsip</th><td class="px-3 py-2 border" x-text="selected?.unit_pengolah_arsip ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Ruangan</th><td class="px-3 py-2 border" x-text="selected?.ruangan ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">No Box</th><td class="px-3 py-2 border" x-text="selected?.no_box ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">No Filling</th><td class="px-3 py-2 border" x-text="selected?.no_filling ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">No Laci</th><td class="px-3 py-2 border" x-text="selected?.no_laci ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">No Folder</th><td class="px-3 py-2 border" x-text="selected?.no_folder ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left w-48 bg-gray-50">Keterangan</th><td class="px-3 py-2 border" x-text="selected?.keterangan ?? '-'"></td></tr>
                                        <tr>
                                            <th class="px-3 py-2 border text-left w-48 bg-gray-50">Dokumen</th>
                                            <td class="px-3 py-2 border">
                                                <template x-if="selected?.upload_dokumen">
                                                    <a :href="'/storage/' + selected.upload_dokumen" target="_blank" class="text-blue-600 underline hover:text-blue-800">Lihat File</a>
                                                </template>
                                                <template x-if="!selected?.upload_dokumen">-</template>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script>
    // Script untuk popup notifikasi
    document.addEventListener("DOMContentLoaded", () => {
        let notif = document.getElementById("popupNotif");
        if (notif) {
            setTimeout(() => {
                notif.style.transition = "opacity 0.5s ease";
                notif.style.opacity = "0";
                setTimeout(() => notif.remove(), 500);
            }, 3000);
        }
    });
</script>
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