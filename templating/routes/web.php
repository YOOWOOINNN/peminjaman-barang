<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('profile.show') : redirect()->route('login');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'store')->name('register.store');
});

Route::middleware(['auth'])->group(function () {

    // --- Profile & Dashboard ---
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- Manajemen Barang (ProductProfile) ---
    Route::controller(ProductProfileController::class)->group(function () {
        // Lihat Daftar Barang
        Route::get('/barang', 'index')->name('productProfile.index');
        
        // Tambah Barang Baru
        Route::post('/barang', 'store')->name('productProfile.store');
        
        // Update / Edit Barang
        Route::put('/barang/{id}', 'update')->name('productProfile.update');
        
        // Hapus Barang
        Route::delete('/barang/{id}', 'destroy')->name('productProfile.destroy');
    });

    // --- Transaksi ---
    // SEKARANG DITAMBAHKAN 'index' agar GET /transaksi bisa diakses
    Route::resource('/transaksi', TransaksiController::class)->only(['index', 'create', 'store']);

});