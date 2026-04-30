<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    // Sesuaikan fillable dengan kolom yang kita simpan di Controller
    protected $fillable = [
        'item_id',        // Mengganti barang_id agar sinkron dengan database
        'user_id',        // Penting agar riwayat per customer bisa dilacak
        'jenis',          // 'masuk' atau 'keluar' (dipinjam/dikembalikan)
        'jumlah',
        'keterangan',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];

    /**
     * Relasi ke model Item (Barang)
     */
    public function item()
    {
        // Pastikan foreign key di database adalah item_id
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * Relasi ke model User (Customer)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}