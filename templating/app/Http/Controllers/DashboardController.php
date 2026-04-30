<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Pastikan ini sama dengan yang ada di ProductProfileController
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung jumlah baris di tabel items
        $totalBarang = Item::count(); 

        // 2. Menghitung total isi kolom 'stok' dari semua baris
        $totalStok = Item::sum('stok');

        // 3. Menghitung jumlah user terdaftar
        $userAktif = User::count();

        // 4. Placeholder untuk request (bisa dikembangkan nanti)
        $pendingRequest = 0;

        // Kirim semua variabel ke view dashboard.blade.php
        return view('dashboard', compact('totalBarang', 'totalStok', 'userAktif', 'pendingRequest'));
    }
}