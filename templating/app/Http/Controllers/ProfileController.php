<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item; // Tambahkan ini untuk mengakses data barang

class ProfileController extends Controller
{
    public function show()
    {
        // 1. Ambil data user yang sedang login
        $user = Auth::user(); 
        
        // 2. Hitung Total Unit (Jumlah seluruh stok di tabel items)
        // Jika data kosong, otomatis akan bernilai 0
        $totalUnit = Item::sum('stok');
        
        // 3. Hitung Total Jenis Barang (Jumlah baris di tabel items)
        $totalBarang = Item::count();

        // Kirim semua variabel ke view profile/dashboard
        return view('profile', compact('user', 'totalUnit', 'totalBarang'));
    }
}