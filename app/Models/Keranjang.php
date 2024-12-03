<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $primaryKey = 'cart_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'cart_id',
        'user_id',
        'product_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class ,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Produk::class ,'product_id');
    }
}
