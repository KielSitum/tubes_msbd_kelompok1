<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'product_id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'product_id',
        'detail_id',
        'product_name',
        'product_expired',
        'product_stock',
        'product_buy_price',
        'product_sell_price',
        'product_status',
    ];

    public function description()
    {
        return $this->belongsTo(DeskripsiProduk::class, 'description_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailProduk::class, 'product_id');
    }

    public function cart()
    {
        return $this->hasMany(Keranjang::class, 'product_id');
    }
}
