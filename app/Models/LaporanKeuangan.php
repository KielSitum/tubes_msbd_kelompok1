<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;
    protected $table = 'laporan_keuangan'; 
    protected $primaryKey = 'id_laporan'; 

    protected $fillable = [
        'tanggal_laporan',
        'pendapatan_kotor',
        'pendapatan_bersih',
        'jumlah_transaksi',
        'total_pengeluaran',
        'catatan',
    ];
}
