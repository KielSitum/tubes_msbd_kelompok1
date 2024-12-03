<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'category_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'category',
    ];

    public function product_description(){
        return $this->hasMany(DeskripsiProduk::class, 'category_id');
    }
}
