<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>DAFTAR ARSIP UNIT - SIPANDU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex min-h-screen bg-[#EDF2F9]">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#8E9BAB] text-white flex flex-col">
        <div class="px-3 py-2 bg-[#68778B] flex items-center">
            <img src="/images/logo.png" class="h-16" alt="logo">
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <div class="text-xs font-bold uppercase tracking-wide text-white p-4 mb-3">Selamat Datang</div>

            <a href="{{ url('/ppidstatis') }}"
               class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/verifikasi') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out  font-semibold">
                <img src="/images/verif.png" alt="" class="w-6 h-6 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Verifikasi Arsip</span>
            </a>

            <a href="{{ url('/dap') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out text-[#003B69] font-semibold">
                <img src="/images/daftarbiru.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Publik</span>
            </a>
        </nav>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col">
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded">Unit Pengolah TMB</div>
            <button class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                <img src="/images/user.png" class="w-5 h-5" alt="user"><span>Log Out</span>
            </button>
        </header>

        <main class="p-6 space-y-6" x-data="{ showModal: false, selected: null }">
            <div class="bg-white p-5 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Daftar Arsip Unit</h2>

                <!-- Filter Unit Pengolah -->
                <form class="mb-4 flex items-center space-x-2">
                    <div class="relative">
                        <select class="w-96 border rounded px-3 py-2 text-gray-700 pr-8 appearance-none">
                            <option value="">Cari Judul...</option>
                            <option value="Arsip A">Arsip A</option>
                            <option value="Arsip B">Arsip B</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">▼</div>
                    </div>

                    <button type="button" class="bg-[#003B69] text-white px-3 py-2 rounded hover:bg-[#00509E]">Cari</button>
                    <button type="button" class="bg-gray-400 text-white px-3 py-2 rounded hover:bg-gray-500">Reset</button>
                </form>

                <!-- Tabel -->
                <div class="overflow-auto max-h-[56vh] border border-gray-200 rounded">
                    <table class="min-w-full text-sm">
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
                                <th class="px-3 py-2 border">SKKAAD</th>
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($arsipPublik as $key => $item)
                        <tr>
                            <td class="px-3 py-2 border text-center">{{ $key + 1 }}</td>
                            <td class="px-3 py-2 border">{{ $item->kodeKlasifikasi->kode ?? '-' }}</td>
                            <td class="px-3 py-2 border">{{ $item->kategori }}</td>
                            <td class="px-3 py-2 border">{{ $item->judul }}</td>
                            <td class="px-3 py-2 border">{{ $item->indeks }}</td>
                            <td class="px-3 py-2 border">{{ $item->uraian_informasi }}</td>
                            <td class="px-3 py-2 border">{{ $item->tanggal }}</td>
                            <td class="px-3 py-2 border">{{ $item->jumlah }}</td>
                            <td class="px-3 py-2 border">{{ $item->tingkat_perkembangan }}</td>
                            <td class="px-3 py-2 border">{{ $item->ruangan }}</td>
                            <td class="px-3 py-2 border">{{ $item->skkaad }}</td>
                            <td class="px-3 py-2 border text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    <button 
                                        class="bg-gray-600 text-white px-2 py-1 rounded hover:bg-gray-400 transition font-semibold"
                                        @click="showModal = true; selected = { 
                                            kode_klasifikasi: '{{ $item->kodeKlasifikasi->kode ?? '-' }}',
                                            kategori: '{{ $item->kategori }}',
                                            judul: '{{ $item->judul }}',
                                            indeks: '{{ $item->indeks }}',
                                            uraian_informasi: '{{ $item->uraian_informasi }}',
                                            tanggal: '{{ $item->tanggal }}',
                                            tingkat_perkembangan: '{{ $item->tingkat_perkembangan }}',
                                            jumlah: '{{ $item->jumlah }}',
                                            satuan: '{{ $item->satuan }}',
                                            unit_pengolah_arsip: '{{ $item->unitPengolah->nama_unit ?? '-' }}',
                                            ruangan: '{{ $item->ruangan }}',
                                            no_filling: '{{ $item->no_filling }}',
                                            no_laci: '{{ $item->no_laci }}',
                                            no_folder: '{{ $item->no_folder }}',
                                            keterangan: '{{ $item->keterangan }}',
                                            skkaad: '{{ $item->skkaad }}',
                                            upload_dokumen: '{{ $item->upload_dokumen }}'
                                        }">
                                        Selengkapnya
                                    </button>

                                    <form action="{{ route('arsip.publik.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Hapus arsip ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-[#BB5456] text-white px-2 py-1 rounded hover:bg-[#8B6869] transition font-semibold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="px-3 py-2 border text-center text-gray-500">Tidak ada data</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

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

        </main>
    </div>
</body>
</html>
