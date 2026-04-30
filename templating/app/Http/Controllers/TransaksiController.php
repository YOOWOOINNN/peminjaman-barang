<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * --- FUNGSI INDEX ---
     * Menampilkan riwayat transaksi KHUSUS milik user yang login
     */
    public function index()
    {
        // Mengambil data transaksi hanya milik customer yang sedang login
        // Menggunakan relasi 'item' agar bisa menampilkan nama barang di view
        $transaksi = Transaksi::with('item')
            ->where('user_id', Auth::id()) 
            ->latest()
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * --- FUNGSI CREATE ---
     * Menampilkan form transaksi untuk barang tertentu
     */
    public function create(Request $request)
    {
        $productId = $request->query('product_id');
        $barang = Item::find($productId);

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        return view('transaksi.create', compact('barang'));
    }

    /**
     * --- FUNGSI STORE ---
     * Menyimpan data transaksi dan mengupdate stok barang
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $item = Item::findOrFail($request->item_id);

            // Logika pengurangan/penambahan stok
            if ($request->jenis == 'keluar') {
                if ($item->stok < $request->jumlah) {
                    DB::rollback(); 
                    return redirect()->back()->with('error', 'Stok tidak mencukupi!');
                }
                $item->stok -= $request->jumlah;
            } else {
                $item->stok += $request->jumlah;
            }
            
            $item->save();

            // Menyimpan transaksi dengan ID user yang login
            Transaksi::create([
                'item_id' => $request->item_id,
                'jenis' => $request->jenis,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
                'user_id' => Auth::id(), // Pastikan user_id tersimpan otomatis
            ]);

            DB::commit();
            
            // Redirect ke halaman index transaksi agar user bisa melihat riwayatnya langsung
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diproses!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    } 
}