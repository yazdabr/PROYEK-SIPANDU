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
            <a href="{{ url('/ppidstatis') }}"
               class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/verifikasi') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out text-[#003B69] font-semibold">
                <img src="/images/verifbiru.png" alt="" class="w-6 h-6 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Verifikasi Arsip</span>
            </a>

            <a href="{{ url('/dap') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out font-semibold">
                <img src="/images/daftar.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Publik</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded [letter-spacing:1px]">
                Oprerator PPID
            </div>
            <button class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                <img src="/images/user.png" alt="User" class="w-5 h-5">
                <span>Log Out</span>
            </button>
        </header>

        <!-- Content -->
        <main class="p-6 space-y-6">
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

            <!-- Judul -->
            <div class="bg-white p-5 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Verifikasi</h2>
                <!-- Wrapper scroll -->
                <div x-data="{ showModal: false, selected: null }">

                    <table class="min-w-full border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-3 py-2 border">No</th>
                                <th class="px-3 py-2 border">Data</th>
                                <th class="px-3 py-2 border">Aksi</th>
                                <th class="px-3 py-2 border">Data Publik/Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($arsip as $key => $item)
                            <tr id="row-{{ $item->id }}">
                                <td class="px-3 py-2 border text-center">{{ $key + 1 }}</td>
                                <td class="px-3 py-2 border">
                                    <div class="flex flex-col space-y-1">
                                        <span><strong>Judul:</strong> {{ $item->judul }}</span>
                                        <span><strong>Nomor Arsip:</strong> {{ $item->nomor_arsip }}</span>
                                        <span><strong>Unit:</strong> {{ $item->unitPengolah->nama_unit ?? '-' }}</span>
                                        @if ($item->upload_dokumen)
                                            <a href="{{ asset('storage/'.$item->upload_dokumen) }}" target="_blank" class="text-blue-500 underline">
                                                Lihat File
                                            </a>
                                        @else
                                            <span class="text-gray-500">Tidak ada file</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-3 py-2 border text-center">
                                    <!-- Tombol Detail -->
                                    <button 
                                        class="bg-gray-600 text-white px-2 py-1 rounded hover:bg-gray-400 transition font-semibold"
                                        @click="showModal = true; selected = {
                                            judul: '{{ $item->judul }}',
                                            nomor: '{{ $item->nomor_arsip }}',
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
                                        Selengkapnya
                                    </button>
                                </td>
                                <td class="px-3 py-2 border">
                                    <div class="flex justify-center space-x-3 font-semibold">
                                        <!-- Tombol YA → Publikasi -->
                                        <form action="{{ route('verifikasi.publik', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mempublikasikan arsip ini?');">
                                            @csrf
                                            <button type="submit" class="bg-[#68778B] text-white px-4 py-2 rounded hover:bg-[#4A5A6B] transition font-semibold">
                                                Ya
                                            </button>
                                        </form>

                                        <!-- Tombol TIDAK → Hapus -->
                                        <form action="{{ route('verifikasi.tidak', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip ini dari verifikasi?');">
                                            @csrf
                                            <button type="submit" class="bg-[#8B6869] text-white px-4 py-2 rounded hover:bg-[#6A4A4B] transition font-semibold">
                                                Tidak
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-3 py-2 border text-center text-gray-500">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Modal detail -->
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
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl p-6 relative">
                            <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-900" @click="showModal = false">&times;</button>
                            <h3 class="text-lg font-bold text-[#003B69] mb-4">Detail Arsip</h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full border border-gray-300 text-sm">
                                    <tbody>
                                        <tr><th class="px-3 py-2 border text-left w-48">No Kode Klasifikasi</th><td class="px-3 py-2 border" x-text="selected?.kode_klasifikasi ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Kategori</th><td class="px-3 py-2 border" x-text="selected?.kategori ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Judul</th><td class="px-3 py-2 border" x-text="selected?.judul ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Indeks</th><td class="px-3 py-2 border" x-text="selected?.indeks ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Uraian Informasi</th><td class="px-3 py-2 border" x-text="selected?.uraian_informasi ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Tanggal</th><td class="px-3 py-2 border" x-text="selected?.tanggal ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Tingkat Perkembangan</th><td class="px-3 py-2 border" x-text="selected?.tingkat_perkembangan ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Jumlah</th><td class="px-3 py-2 border" x-text="selected?.jumlah ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Satuan</th><td class="px-3 py-2 border" x-text="selected?.satuan ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Unit Pengolah Arsip</th><td class="px-3 py-2 border" x-text="selected?.unit_pengolah_arsip ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Ruangan</th><td class="px-3 py-2 border" x-text="selected?.ruangan ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">No Box</th><td class="px-3 py-2 border" x-text="selected?.no_box ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">No Filling</th><td class="px-3 py-2 border" x-text="selected?.no_filling ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">No Laci</th><td class="px-3 py-2 border" x-text="selected?.no_laci ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">No Folder</th><td class="px-3 py-2 border" x-text="selected?.no_folder ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">Keterangan</th><td class="px-3 py-2 border" x-text="selected?.keterangan ?? '-'"></td></tr>
                                        <tr><th class="px-3 py-2 border text-left">SKKAAD</th><td class="px-3 py-2 border" x-text="selected?.skkaad ?? '-'"></td></tr>
                                        <tr>
                                            <th class="px-3 py-2 border text-left">Dokumen</th>
                                            <td class="px-3 py-2 border">
                                                <template x-if="selected?.upload_dokumen">
                                                    <a :href="'/storage/' + selected.upload_dokumen" target="_blank" class="text-blue-600 underline">Lihat</a>
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


</body>
</html>
