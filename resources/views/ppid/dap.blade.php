<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Operator PPID - SIPANDU</title>
        <!-- Tambahkan Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
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

            <a href="{{ url('/ppid/ppidstatis') }}"
               class="flex items-center space-x-2 p-3 rounded bg-[#68778B] hover:bg-gray-500 transition-all duration-300 ease-in-out">
                <img src="/images/dash.png" alt="Dashboard" class="w-5 h-5">
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/ppid/verifikasi') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out  font-semibold">
                <img src="/images/verif.png" alt="" class="w-6 h-6 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Verifikasi Arsip</span>
            </a>

            <a href="{{ url('/ppid/dap') }}"
               class="group flex items-center space-x-2 p-3 rounded hover:bg-[#CBD2DA] transition-all duration-300 ease-in-out text-[#003B69] font-semibold">
                <img src="/images/daftarbiru.png" alt="" class="w-7 h-7 transition-transform duration-300 group-hover:scale-110">
                <span class="transition-transform duration-300 group-hover:translate-x-1">Daftar Arsip Publik</span>
            </a>
        </nav>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col">
        <header class="flex justify-between items-center bg-[#E3E8EE] px-6 py-4">
            <div class="px-3 py-3 bg-[#CBD2DA] text-[#003B69] font-bold rounded [letter-spacing:1px]">
                Operator PPID
            </div>

            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="flex items-center space-x-2 bg-[#CBD2DA] text-[#003B69] font-bold px-3 py-3 rounded hover:bg-gray-300">
                    <img src="/images/user.png" class="w-5 h-5" alt="user">
                    <span>Log Out</span>
                </button>
            </form>
        </header>

        <main class="p-6 space-y-6" x-data="{ showModal: false, selected: null }">
            <div class="bg-white p-5 rounded shadow">
                <h2 class="font-bold text-lg text-[#003B69] mb-4">Operator PPID</h2>

                <!-- Filter PPID -->
                <form class="mb-4 flex items-center space-x-2">
                    <div class="relative">
                        <select id="judulSelect" name="judul" class="w-96 border rounded px-3 py-2 text-gray-700">
                            <option value="">Cari Judul...</option>
                            @foreach($arsipPublik as $arsip)
                                <option value="{{ $arsip->id }}">{{ $arsip->judul }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-[#003B69] text-white px-3 py-2 rounded hover:bg-[#00509E]">Cari</button>
                    <button type="button" 
                            onclick="window.location.href='{{ url('/ppid/dap') }}'" 
                            class="bg-gray-400 text-white px-3 py-2 rounded hover:bg-gray-500">
                        Reset
                    </button> 
                </form>
                <style>
                    .ts-wrapper { z-index: 50; }
                    .ts-dropdown { z-index: 9999 !important; }
                </style>

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
                                <th class="px-3 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($arsipPublik as $key => $item)
                        <tr>
                            <td class="px-3 py-2 border text-center">{{ $key + 1 }}</td>
                            <td class="px-3 py-2 border">{{ $item->kodeKlasifikasi->kode ?? '-' }}</td>
                            <td class="px-3 py-2 border">{{ $item->kategori_berita }}</td>
                            <td class="px-3 py-2 border">{{ $item->judul }}</td>
                            <td class="px-3 py-2 border">{{ $item->indeks }}</td>
                            <td class="px-3 py-2 border">{{ $item->uraian_informasi }}</td>
                            <td class="px-3 py-2 border">{{ $item->tanggal }}</td>
                            <td class="px-3 py-2 border">{{ $item->jumlah }}</td>
                            <td class="px-3 py-2 border">{{ $item->tingkat_perkembangan }}</td>
                            <td class="px-3 py-2 border">{{ $item->ruangan }}</td>
                            <td class="px-3 py-2 border text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    <button 
                                        class="bg-gray-600 text-white px-2 py-1 rounded hover:bg-gray-400 transition font-semibold"
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
                                        <img src="{{ asset('images/more.png') }}" alt="Detail" class="w-5 h-5 object-contain">
                                    </button>
                                    <form action="{{ route('arsip.publik.hapus', $item->id) }}" method="POST" class="deleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="deleteBtn bg-[#BB5456] text-white px-2 py-1 rounded hover:bg-[#8B6869] transition font-semibold">
                                            <img src="{{ asset('images/trash.png') }}" alt="Hapus" class="w-7 h-5 object-contain">
                                        </button>
                                    </form>
                                    <!-- Popup Modal -->
                                    <div id="deleteModal" 
                                        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 opacity-0 transition-opacity duration-300">
                                        <div id="modalContent"
                                            class="bg-white p-6 rounded-lg shadow-lg w-80 text-center transform scale-90 opacity-0 transition-all duration-300">
                                            <h3 class="text-lg font-bold mb-4">Konfirmasi Hapus</h3>
                                            <p class="mb-6">Apakah Anda Ingin Menghapus Arsip Ini?</p>
                                            <div class="flex justify-between">
                                                <button id="cancelBtn" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                                                <button id="confirmBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
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
                <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto p-6 relative my-auto">
                    <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-900" @click="showModal = false">&times;</button>
                    <h3 class="text-lg font-bold text-[#003B69] mb-4">Detail Arsip</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 text-sm">
                            <tbody>
                                <tr><th class="px-3 py-2 border text-left w-48">No Kode Klasifikasi</th><td class="px-3 py-2 border" x-text="selected?.kode_klasifikasi ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left">Kategori</th><td class="px-3 py-2 border" x-text="selected?.kategori_berita ?? '-'"></td></tr>
                                <tr><th class="px-3 py-2 border text-left">Data Publik/Tidak</th><td class="px-3 py-2 border" x-text="selected?.kategori ?? '-'"></td></tr>
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
                                <!-- <tr><th class="px-3 py-2 border text-left">SKKAAD</th><td class="px-3 py-2 border" x-text="selected?.skkaad ?? '-'"></td></tr> -->
                                <tr>
                                    <th class="px-3 py-2 border text-left">Dokumen</th>
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
    <!-- Blade file, misal setelah layout utama -->
@if(session('success'))
    <div id="toast" 
         class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-500">
            {{ session('success') }}
        </div>
    </div>

    <script>
        const toast = document.querySelector('#toast > div');
        toast.classList.remove('opacity-0'); // tampilkan
        toast.classList.add('opacity-100');

        setTimeout(() => {
            toast.classList.add('opacity-0'); // hilangkan otomatis
            setTimeout(() => document.getElementById('toast').remove(), 500); 
        }, 3000); // durasi tampil 3 detik
    </script>
@endif

<script>
    let modal = document.getElementById('deleteModal');
    let modalContent = document.getElementById('modalContent');
    let confirmBtn = document.getElementById('confirmBtn');
    let cancelBtn = document.getElementById('cancelBtn');
    let currentForm;

    // Buka modal
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentForm = this.closest('form');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // efek animasi muncul
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modalContent.classList.remove('scale-90', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 50);
        });
    });

    // Tutup modal
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
</script>
<script>
    new TomSelect("#judulSelect",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>
</body>
</html>
