<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional jika nama tabelnya 'items').
     * Jika nama tabel kamu 'barang', aktifkan baris di bawah:
     */
    // protected $table = 'items';

    /**
     * Mass Assignment: Kolom yang boleh diisi secara masif.
     * Ini harus sesuai dengan input di form barang.blade.php kamu.
     */
    protected $fillable = [
        'nama_barang',
        'stok',
        'deskripsi'
    ];

    /**
     * Casting data (Opsional)
     * Memastikan stok selalu terbaca sebagai angka (integer).
     */
    protected $casts = [
        'stok' => 'integer',
    ];
}