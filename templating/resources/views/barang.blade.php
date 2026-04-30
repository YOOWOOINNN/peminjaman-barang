<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Daftar Barang - Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    </style>
</head>

<body class="bg-slate-950 p-8 relative min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ url('/dashboard') }}" class="text-white hover:text-purple-400 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>
        
        @if(request('search'))
            <span class="text-slate-400 text-sm">
                Menampilkan hasil untuk: <b class="text-purple-400">"{{ request('search') }}"</b> 
                <a href="{{ route('productProfile.index') }}" class="ml-2 text-xs bg-slate-800 px-2 py-1 rounded hover:bg-slate-700 text-white">Reset</a>
            </span>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-lg mb-4">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/20 border border-red-500 text-red-400 p-4 rounded-lg mb-4">
            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="bg-slate-900 p-6 rounded-xl shadow-2xl mb-10 border border-slate-800 fade-in-up">
        <h2 id="form-title" class="text-white text-xl font-bold mb-4">Tambah Barang Baru</h2>

        <form id="main-form" action="{{ route('productProfile.store') }}" method="POST">
            @csrf
            <div id="method-container"></div> 
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex flex-col">
                    <label class="text-slate-400 text-xs mb-1 ml-1">Nama Barang</label>
                    <input type="text" name="nama_barang" id="input_nama" placeholder="Contoh: Proyektor Epson"
                        class="p-3 rounded-lg bg-slate-800 text-white border border-slate-700 focus:outline-none focus:border-purple-500 transition-all" required>
                </div>

                <div class="flex flex-col">
                    <label class="text-slate-400 text-xs mb-1 ml-1">Jumlah Stok</label>
                    <input type="number" name="stok" id="input_stok" placeholder="0"
                        class="p-3 rounded-lg bg-slate-800 text-white border border-slate-700 focus:outline-none focus:border-purple-500 transition-all" required>
                </div>

                <div class="flex flex-col">
                    <label class="text-slate-400 text-xs mb-1 ml-1">Deskripsi Singkat</label>
                    <input type="text" name="deskripsi" id="input_deskripsi" placeholder="Opsional"
                        class="p-3 rounded-lg bg-slate-800 text-white border border-slate-700 focus:outline-none focus:border-purple-500 transition-all">
                </div>
            </div>

            <div class="flex gap-2 mt-6">
                <button type="submit" id="submit-btn"
                    class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-lg text-white font-bold transition-all shadow-lg shadow-purple-900/20">
                    <i class="fas fa-save mr-2"></i> <span id="btn-text">Simpan Barang</span>
                </button>
                
                <button type="button" id="cancel-btn" onclick="resetForm()"
                    class="px-6 py-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-bold hidden transition-all">
                    Batal
                </button>
            </div>
        </form>
    </div>

    <div class="bg-slate-900 p-6 rounded-xl shadow-2xl border border-slate-800">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-white text-xl font-bold flex items-center">
                <i class="fas fa-list mr-3 text-purple-500"></i> Daftar Inventaris
            </h2>
            <a href="{{ url('/transaksi') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold rounded-lg border border-slate-700 transition-all">
                <i class="fas fa-history mr-2"></i> RIWAYAT TRANSAKSI
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-white">
                <thead class="bg-slate-800/50">
                    <tr>
                        <th class="p-4 text-left text-slate-400 font-medium uppercase text-xs tracking-wider">Nama Barang</th>
                        <th class="p-4 text-left text-slate-400 font-medium uppercase text-xs tracking-wider">Stok</th>
                        <th class="p-4 text-left text-slate-400 font-medium uppercase text-xs tracking-wider">Deskripsi</th>
                        <th class="p-4 text-left text-slate-400 font-medium uppercase text-xs tracking-wider">Tgl Input</th>
                        <th class="p-4 text-center text-slate-400 font-medium uppercase text-xs tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($items as $item)
                        <tr class="hover:bg-slate-800/30 transition-colors group">
                            <td class="p-4 font-medium">{{ $item->nama_barang }}</td>
                            <td class="p-4">
                                @if($item->stok <= 0)
                                    <span class="bg-red-500/10 text-red-500 border border-red-500/20 px-2 py-1 rounded text-xs font-bold">Kosong</span>
                                @else
                                    <span class="text-green-400 font-semibold">{{ $item->stok }} <small class="text-slate-500">Unit</small></span>
                                @endif
                            </td>
                            <td class="p-4 text-slate-400 italic text-sm">{{ $item->deskripsi ?: '-' }}</td>
                            <td class="p-4 text-slate-500 text-xs">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="p-4">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('transaksi.create', ['product_id' => $item->id]) }}" 
                                       class="p-2 text-emerald-400 hover:bg-emerald-500/10 rounded-lg transition-all" 
                                       title="Transaksi (Pinjam/Keluar)">
                                        <i class="fas fa-exchange-alt"></i>
                                    </a>

                                    <button onclick="prepareEdit('{{ $item->id }}', '{{ addslashes($item->nama_barang) }}', '{{ $item->stok }}', '{{ addslashes($item->deskripsi) }}')" 
                                        class="p-2 text-blue-400 hover:bg-blue-500/10 rounded-lg transition-all" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('productProfile.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus barang ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-all" title="Hapus Data">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-slate-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-box-open text-5xl mb-4 opacity-20"></i>
                                    <p class="text-lg">
                                        {{ request('search') ? 'Barang tidak ditemukan' : 'Gudang masih kosong' }}
                                    </p>
                                    <p class="text-sm">
                                        {{ request('search') ? 'Coba gunakan kata kunci lain.' : 'Silakan tambah barang melalui form di atas.' }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const form = document.getElementById('main-form');
        const formTitle = document.getElementById('form-title');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const cancelBtn = document.getElementById('cancel-btn');
        const methodContainer = document.getElementById('method-container');

        function prepareEdit(id, nama, stok, deskripsi) {
            window.scrollTo({top: 0, behavior: 'smooth'});
            
            formTitle.innerHTML = `<i class="fas fa-edit text-blue-500 mr-2"></i> Edit Barang`;
            btnText.innerText = "Simpan Perubahan";
            submitBtn.classList.replace('bg-purple-600', 'bg-blue-600');
            submitBtn.classList.replace('hover:bg-purple-700', 'hover:bg-blue-700');
            cancelBtn.classList.remove('hidden');

            document.getElementById('input_nama').value = nama;
            document.getElementById('input_stok').value = stok;
            document.getElementById('input_deskripsi').value = (deskripsi === 'null' || !deskripsi) ? '' : deskripsi;

            form.action = `/barang/${id}`;
            methodContainer.innerHTML = `<input type="hidden" name="_method" value="PUT">`;
        }

        function resetForm() {
            formTitle.innerHTML = "Tambah Barang Baru";
            btnText.innerText = "Simpan Barang";
            submitBtn.classList.replace('bg-blue-600', 'bg-purple-600');
            submitBtn.classList.replace('hover:bg-blue-700', 'hover:bg-purple-700');
            cancelBtn.classList.add('hidden');
            
            form.reset();
            form.action = "{{ route('productProfile.store') }}";
            methodContainer.innerHTML = '';
        }
    </script>
</body>
</html>