<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ProductProfileController extends Controller
{
    /**
     * Menampilkan daftar barang (Sekarang Mendukung Fitur Search)
     */
    public function index(Request $request)
    {
        // 1. Tangkap kata kunci dari input 'search' yang dikirim dari form
        $search = $request->query('search');

        // 2. Query data barang dengan filter pencarian
        $items = Item::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_barang', 'like', "%{$search}%")
                             ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        // 3. Return ke view 'barang' dengan data yang sudah difilter
        return view('barang', compact('items'));
    }

    /**
     * Menyimpan barang baru
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
        ]);

        Item::create($validated);

        return redirect()
            ->route('productProfile.index')
            ->with('success', 'Barang baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui data barang (Edit)
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()
            ->route('productProfile.index')
            ->with('success', 'Data barang berhasil diperbarui!');
    }

    /**
     * Menghapus barang
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('productProfile.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}