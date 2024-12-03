<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogStok extends Model
{
    use HasFactory;

    protected $table = 'log_stok'; // Nama tabel
    protected $primaryKey = 'id_log_stok'; // Primary key
    public $timestamps = true; // Menggunakan timestamps

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'id_obat',
        'tanggal_perubahan',
        'jenis_perubahan',
        'jumlah',
        'keterangan',
    ];
}
