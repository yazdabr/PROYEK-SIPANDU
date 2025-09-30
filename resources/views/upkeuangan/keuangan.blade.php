<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>TATA USAHA KEUANGAN - PORTAL DATA TERPADU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <style>
        .ts-wrapper { z-index: 50; }
        .ts-dropdown { z-index: 9999 !important; }

        /* Custom CSS untuk Sticky Action Column */
        @media (min-width: 768px) {
            .sticky-action-column {
                /* Membuat kolom menempel di kanan saat tabel digulir */
                position: sticky; 
                right: 0;
                /* Berikan latar belakang untuk menutupi konten di belakangnya */
                background-color: #f3f4f6; /* bg-gray-100 */
                z-index: 15; /* Lebih tinggi dari thead (z-10) */
                box-shadow: -3px 0 5px rgba(0, 0, 0, 0.1);
            }
            
            /* Latar belakang yang lebih gelap untuk header kolom aksi */
            .sticky-action-column.header {
                background-color: #e5e7eb; /* bg-gray-200 */
                z-index: 20; /* Lebih tinggi agar tombol di bawahnya tidak menutupi header saat scroll */
            }
        }
        
        /* Alpine.js: Sembunyikan saat inisialisasi */
        [x-cloak] { display: none !important; }

        /* Tambahkan style untuk mengatasi masalah tombol aksi mobile terpotong */
        .mobile-actions-container {
            min-width: 150px; /* Memberikan lebar minimum agar tombol tidak berdesakan */
        }
    </style>
</head>
<body class="flex min-h-screen bg-[#EDF2F9]" x-data="{ isSidebarOpen: window.innerWidth >= 768 }"> 
    
    <div 
        class="fixed inset-0 bg-black bg-opacity-50 z-[9999] md:hidden" 
        x-show="isSidebarOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="isSidebarOpen = false"
        x-cloak
    ></div>

<aside 
    class="fixed inset-y-0 left-0 z-[10000] w-64 bg-[#8E9BAB] text-white flex flex-col transform transition-transform duration-300 ease-in-out md:static md:translate-x-0"
    :class="{ 'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen}"
    x-cloak
>
    <div class="px-3 py-2 bg-[#68778B] flex items-center justify-between shadow-md">
        <img src="/images/logo.png" class="h-16" alt="logo">
        <button @click="isSidebarOpen = false" class="md:hidden p-2 text-white hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        <div class="text-xs font-bold uppercase tracking-wide text-white rounded [letter-spacing:4px] p-4 mb-3">
            Selamat Datang
        </div>

        <a href="{{ url('/upkeuangan/keuangandashboard') }}"
            class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
            <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
            <span>Dashboard</span>
        </a>

        <a href="{{ url('/upkeuangan/keuanganinput') }}"
            class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold ">
            <img src="/images/input.png" alt="Input Arsip" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
            <span class="transition-transform duration-300 group-hover:translate-x-1">Input Arsip</span>
        </a>

        <a href="{{ url('/upkeuangan/keuangan') }}"
            class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold text-[#003B69]">
            <img src="/images/daftarbiru.png" alt="Daftar Arsip Unit" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
            <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Unit</span>
        </a>
    </nav>
    
    <div class="p-4 md:hidden">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-400 transition-all duration-200">
                <img src="/images/user.png" class="w-5 h-5" alt="user">
                <span>Log Out</span>
            </button>
        </form>
    </div>
</aside>


    <div class="flex-1 flex flex-col overflow-x-hidden">
        <header class="flex items-center bg-[#E3E8EE] px-6 py-4 sticky top-0 z-30 shadow-md">
            <button 
                class="md:hidden p-2 text-gray-600 hover:text-gray-800" 
                @click="isSidebarOpen = true"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
            
            <div class="ml-auto lg:ml-0 px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded">
                TATA USAHA KEUANGAN
            </div>

            <form action="{{ route('logout') }}" method="POST" class="hidden lg:flex ml-auto">
                @csrf
                <button type="submit" class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-400 transition-all duration-200">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </form>
        </header>

        <main class="p-4 md:p-6 space-y-6 flex-1 overflow-y-auto" x-data="{ showModal: false, selected: null }">

            <div class="bg-white p-4 md:p-5 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Daftar Arsip Unit</h2>

                <form action="{{ url()->current() }}" method="GET" class="mb-4 flex flex-wrap items-center gap-2">
                    <div class="relative flex-1 min-w-[200px] max-w-full md:max-w-xs"
                        :class="{ 'pointer-events-none': isSidebarOpen && window.innerWidth < 768 }">
                        <select id="judulSelect" name="judul" class="w-full border rounded px-3 py-2 text-gray-700">
                            <option value="">Cari Judul...</option>
                            @foreach($judulList as $judul)
                                <option value="{{ $judul }}" {{ request('judul') == $judul ? 'selected' : '' }}>
                                    {{ $judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-[#003B69] text-white px-3 py-2 rounded hover:bg-[#00509E] flex-shrink-0">
                        Cari
                    </button>
                    <button type="button" onclick="window.location.href='{{ url('/keuangan/keuangan') }}'" 
                        class="bg-gray-400 text-white px-3 py-2 rounded hover:bg-gray-500 flex-shrink-0">
                        Reset
                    </button>
                </form>

                <div class="overflow-x-auto max-h-[70vh] md:max-h-[56vh] border border-gray-200 rounded">
                    <table class="hidden md:table min-w-full text-sm">
                        <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                            <tr>
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">No Kode Klasifikasi</th>
                                <th class="px-3 py-2 border">Kategori</th>
                                <th class="px-3 py-2 border">Judul Berkas</th>
                                <th class="px-3 py-2 border">Indeks</th>
                                <th class="px-3 py-2 border">Uraian Informasi</th>
                                <th class="px-3 py-2 border">Tanggal</th>
                                <th class="px-3 py-2 border">Jumlah</th>
                                <th class="px-3 py-2 border">Tingkat Perkembangan</th>
                                <th class="px-3 py-2 border">Ruangan</th>
                                {{-- PERBAIKAN: Tambahkan kelas 'header' untuk z-index yang tepat --}}
                                <th class="px-3 py-2 border sticky-action-column header">Aksi</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arsip as $index => $item)
                                <tr>
                                    <td class="px-3 py-2 border text-center">{{ $index+1 }}</td>
                                    <td class="px-3 py-2 border whitespace-nowrap">{{ $item->kodeKlasifikasi->kode ?? '-' }}</td>
                                    <td class="px-3 py-2 border whitespace-nowrap">{{ $item->kategori_berita }}</td>
                                    <td class="px-3 py-2 border min-w-[200px]">{{ $item->judul }}</td>
                                    <td class="px-3 py-2 border">{{ $item->indeks }}</td>
                                    <td class="px-3 py-2 border min-w-[200px]">{{ $item->uraian_informasi }}</td>
                                    <td class="px-3 py-2 border whitespace-nowrap">{{ $item->tanggal }}</td>
                                    <td class="px-3 py-2 border text-center">{{ $item->jumlah }}</td>
                                    <td class="px-3 py-2 border whitespace-nowrap">{{ $item->tingkat_perkembangan }}</td>
                                    <td class="px-3 py-2 border">{{ $item->ruangan }}</td>
                                    {{-- PERBAIKAN: Hapus whitespace-nowrap dan tambahkan kelas sticky --}}
                                    <td class="px-3 py-2 border text-center sticky-action-column"> 
                                        <div class="flex justify-center items-center space-x-2">
                                        <button 
                                            class="bg-gray-600 text-white p-1 rounded hover:bg-gray-400 transition font-semibold"
                                            @click="showModal = true; selected = {
                                                judul: '{{ addslashes($item->judul) }}',
                                                nomor: '{{ $item->nomor_arsip }}',
                                                kategori_berita: '{{ $item->kategori_berita }}',
                                                kategori: '{{ $item->kategori }}',
                                                kode_klasifikasi: '{{ $item->kodeKlasifikasi->kode ?? '-' }}',
                                                indeks: '{{ $item->indeks }}',
                                                uraian_informasi: '{{ addslashes($item->uraian_informasi) }}',
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
                                                keterangan: '{{ addslashes($item->keterangan) }}',
                                                skkaad: '{{ $item->skkaad }}',
                                                upload_dokumen: '{{ $item->upload_dokumen }}'
                                            }"
                                            title="Selengkapnya"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>

        <a href="{{ route('keuanganedit.edit', $item->id) }}" 
            class="inline bg-[#4A90E2] text-white p-1 rounded hover:bg-[#357ABD] transition font-semibold"
            title="Edit">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
            </svg>
        </a>

        <form action="{{ route('keuangan.destroy', $item->id) }}" method="POST" class="inline deleteForm">
            @csrf
            @method('DELETE')
            <button type="button" class="bg-[#BB5456] text-white p-1 rounded hover:bg-[#8B6869] transition font-semibold deleteBtn" title="Hapus">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Tampilan Mobile --}}
                    <div class="md:hidden p-2 space-y-3">
                        @forelse ($arsip as $index => $item)
                        <div class="bg-white p-3 rounded-lg shadow border border-gray-200">
                            <div class="font-bold text-base text-[#003B69] mb-2">({{ $index+1 }}) {{ $item->judul }}</div>
                            <div class="text-sm space-y-1">
                                <p><span class="font-semibold w-28 inline-block">Kode Klasifikasi:</span> {{ $item->kodeKlasifikasi->kode ?? '-' }}</p>
                                <p><span class="font-semibold w-28 inline-block">Kategori:</span> {{ $item->kategori_berita }}</p>
                                <p><span class="font-semibold w-28 inline-block">Tanggal:</span> {{ $item->tanggal }}</p>
                                <p><span class="font-semibold w-28 inline-block">Ruangan:</span> {{ $item->ruangan }}</p>
                                <p><span class="font-semibold w-28 inline-block">Uraian:</span> {{ $item->uraian_informasi }}</p>
                            </div>
                            <div class="flex justify-end items-center space-x-2 mt-3 mobile-actions-container">
                                <button 
                                    class="bg-gray-600 text-white px-2 py-1 rounded hover:bg-gray-400 transition text-xs"
                                    @click="showModal = true; selected = {
                                        judul: '{{ addslashes($item->judul) }}',
                                        nomor: '{{ $item->nomor_arsip }}',
                                        kategori_berita: '{{ $item->kategori_berita }}',
                                        kategori: '{{ $item->kategori }}',
                                        kode_klasifikasi: '{{ $item->kodeKlasifikasi->kode ?? '-' }}',
                                        indeks: '{{ $item->indeks }}',
                                        uraian_informasi: '{{ addslashes($item->uraian_informasi) }}',
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
                                        keterangan: '{{ addslashes($item->keterangan) }}',
                                        skkaad: '{{ $item->skkaad }}',
                                        upload_dokumen: '{{ $item->upload_dokumen }}'
                                    }"
                                >
                                    Detail
                                </button>
                                <a href="{{ route('keuanganedit.edit', $item->id) }}" 
                                    class="inline bg-[#4A90E2] text-white px-2 py-1 rounded hover:bg-[#357ABD] transition text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('keuangan.destroy', $item->id) }}" method="POST" class="inline deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="bg-[#BB5456] text-white px-2 py-1 rounded hover:bg-[#8B6869] transition text-xs deleteBtn">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-gray-500 py-4">Tidak Ada Data Arsip Unit Ditemukan</div>
                        @endforelse
                    </div>

                    @if ($arsip->isEmpty())
                        <div class="text-center text-gray-500 py-4 hidden md:block">Tidak Ada Data Arsip Unit Ditemukan</div>
                    @endif
                </div>

            </div>

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
                                <tr>
                                    <th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">No Kode Klasifikasi</th>
                                    <td class="px-3 py-2 border" x-text="selected?.kode_klasifikasi ?? '-'"></td>
                                </tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Kategori</th><td class="px-3 py-2 border" x-text="selected?.kategori_berita ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Data Publik/Tidak</th><td class="px-3 py-2 border" x-text="selected?.kategori ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Judul</th><td class="px-3 py-2 border" x-text="selected?.judul ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Nomor</th><td class="px-3 py-2 border" x-text="selected?.nomor ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Indeks</th><td class="px-3 py-2 border" x-text="selected?.indeks ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Uraian Informasi</th><td class="px-3 py-2 border" x-text="selected?.uraian_informasi ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Tanggal</th><td class="px-3 py-2 border" x-text="selected?.tanggal ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Tingkat Perkembangan</th><td class="px-3 py-2 border" x-text="selected?.tingkat_perkembangan ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Jumlah</th><td class="px-3 py-2 border" x-text="selected?.jumlah ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Satuan</th><td class="px-3 py-2 border" x-text="selected?.satuan ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Unit Pengolah Arsip</th><td class="px-3 py-2 border" x-text="selected?.unit_pengolah_arsip ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Ruangan</th><td class="px-3 py-2 border" x-text="selected?.ruangan ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">No Box</th><td class="px-3 py-2 border" x-text="selected?.no_box ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">No Filling</th><td class="px-3 py-2 border" x-text="selected?.no_filling ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">No Laci</th><td class="px-3 py-2 border" x-text="selected?.no_laci ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">No Folder</th><td class="px-3 py-2 border" x-text="selected?.no_folder ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Keterangan</th><td class="px-3 py-2 border" x-text="selected?.keterangan ?? '-'"></td></tr>
                                <tr>
                                    <th class="px-3 py-2 border text-left w-1/3 md:w-48 whitespace-nowrap">Dokumen</th>
                                    <td class="px-3 py-2 border">
                                        <template x-if="selected?.upload_dokumen">
                                            <a :href="'/storage/' + selected.upload_dokumen" target="_blank" class="bg-[#7592BA] text-white px-2 py-1 rounded hover:bg-[#B4D0F6] transition font-semibold">Lihat</a>
                                        </template>
                                        <template x-if="!selected?.upload_dokumen">-</template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </main>
    </div>

@if(session('success'))
    <div 
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transform transition ease-out duration-500"
        x-transition:enter-start="translate-y-6 opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-6 opacity-0"
        class="fixed bottom-5 left-1/2 -translate-x-1/2 z-[9999] pointer-events-none"
    >
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg text-center pointer-events-auto">
            {{ session('success') }}
        </div>
    </div>
@endif

    <div id="deleteModal" 
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-[99999] opacity-0 transition-opacity duration-300">
        <div id="modalContent"
            class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-sm text-center transform scale-90 opacity-0 transition-all duration-300">
            <h3 class="text-lg font-bold mb-4">Konfirmasi Hapus</h3>
            <p class="mb-6">Apakah Anda Ingin Menghapus Arsip Ini?</p>
            <div class="flex justify-between">
                <button id="cancelBtn" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button id="confirmBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        // Logika Modal Hapus (tidak diubah)
        let modal = document.getElementById('deleteModal');
        let modalContent = document.getElementById('modalContent');
        let confirmBtn = document.getElementById('confirmBtn');
        let cancelBtn = document.getElementById('cancelBtn');
        let currentForm;

        document.querySelectorAll('.deleteBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                currentForm = this.closest('form');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    modal.classList.add('opacity-100');
                    modalContent.classList.remove('scale-90', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 50);
            });
        });

        function closeModal() {
            modal.classList.remove('opacity-100');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-90', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        cancelBtn.addEventListener('click', closeModal);

        confirmBtn.addEventListener('click', function() {
            if(currentForm) currentForm.submit();
            closeModal();
        });

        // Tom-Select Initialization (tidak diubah)
        new TomSelect("#judulSelect", {
            create: false,
            sortField: { field: "text", direction: "asc" },
            placeholder: "Cari Judul..."
        });

        // Alpine.js untuk menyesuaikan sidebar saat resize (tidak diubah)
        window.addEventListener('resize', () => {
            const sidebarState = document.querySelector('[x-data]').__x.$data.isSidebarOpen;
            if (window.innerWidth >= 768 && !sidebarState) {
                document.querySelector('[x-data]').__x.$data.isSidebarOpen = true;
            }
        });
    </script>
</body>
</html>