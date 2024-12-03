<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    use HasFactory;

    protected $table = 'detail_produk';
    protected $primaryKey = 'detail_id';
    public $incrementing = false;
    public $timestamps = false;
    

    protected $guarded = [
        'id',
    ];

    public function product()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}
