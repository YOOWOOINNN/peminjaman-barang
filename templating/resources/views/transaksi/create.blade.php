<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Transaksi Barang - {{ $barang->nama_barang }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-950 p-8 min-h-screen flex items-center justify-center">

    <div class="bg-slate-900 p-8 rounded-2xl shadow-2xl border border-slate-800 w-full max-w-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-white text-2xl font-bold">Form Transaksi</h2>
            <a href="{{ url('/barang') }}" class="text-slate-400 hover:text-white transition">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>

        <div class="mb-6 p-4 bg-slate-800/50 rounded-lg border border-slate-700">
            <p class="text-slate-400 text-xs uppercase tracking-widest mb-1">Barang yang dipilih:</p>
            <h3 class="text-purple-400 text-lg font-bold">{{ $barang->nama_barang }}</h3>
            <p class="text-slate-500 text-sm">Stok Tersedia: <span class="text-green-400">{{ $barang->stok }} Unit</span></p>
        </div>

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="item_id" value="{{ $barang->id }}">

            <div class="space-y-4">
                <div>
                    <label class="text-slate-400 text-sm mb-2 block">Jenis Transaksi</label>
                    <select name="jenis" class="w-full p-3 rounded-lg bg-slate-800 text-white border border-slate-700 focus:outline-none focus:border-purple-500 transition-all">
                        <option value="keluar">Barang Keluar / Pinjam</option>
                        <option value="masuk">Barang Masuk / Tambah Stok</option>
                    </select>
                </div>

                <div>
                    <label class="text-slate-400 text-sm mb-2 block">Jumlah</label>
                    <input type="number" name="jumlah" min="1" max="{{ $barang->stok }}" placeholder="0" required
                        class="w-full p-3 rounded-lg bg-slate-800 text-white border border-slate-700 focus:outline-none focus:border-purple-500 transition-all">
                </div>

                <div>
                    <label class="text-slate-400 text-sm mb-2 block">Keterangan / Nama Peminjam</label>
                    <textarea name="keterangan" rows="3" placeholder="Contoh: Dipinjam oleh Andi untuk presentasi"
                        class="w-full p-3 rounded-lg bg-slate-800 text-white border border-slate-700 focus:outline-none focus:border-purple-500 transition-all"></textarea>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <button type="submit" class="flex-1 py-3 bg-purple-600 hover:bg-purple-700 rounded-lg text-white font-bold transition-all shadow-lg shadow-purple-900/20">
                    Proses Transaksi
                </button>
                <a href="{{ url('/barang') }}" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-bold text-center transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>