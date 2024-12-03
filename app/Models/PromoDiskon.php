<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoDiskon extends Model
{
    use HasFactory;

    protected $table = 'promo_diskon'; // Nama tabel
    protected $primaryKey = 'id_promo'; // Primary key
    public $timestamps = true; // Menggunakan timestamps

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'nama_promo',
        'nilai_diskon',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];
}
