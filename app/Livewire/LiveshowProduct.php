<?php

namespace App\Livewire;

use App\Models\Kategori;
use App\Models\Group;
use App\Models\Produk;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LiveshowProduct extends Component
{
    protected $listeners = ["liveshow"];
    public $products;
    public $cari;
    public $filter;
    public $kategori;
    public $golongan;
    public $bentuk;
    public $minimum;
    public $maksimum;
    public $product_id;

    public function mount($filter, $kategori, $golongan, $bentuk, $minimum, $maksimum){
        $this->filter = $filter;
        $this->kategori = $kategori;
        $this->golongan = $golongan;
        $this->bentuk = $bentuk;
        $this->minimum = $minimum;
        $this->maksimum = $maksimum;
    }

    public function liveshow($cari){
        // dd($this->kategori);
        // dd($cari); 
        // filter kategori
        if ($this->kategori) {
            if (Category::on('user')->where('category', $this->kategori)->first() != NULL) {
                // ubah menjadi view
                $product = Produk::on('user')->whereHas('description.category', function ($query) { 
                    $query->where('category', $this->kategori);
                });
            }else{
                $product = NULL;
            }
        }
        // akhir filter kategori

        // filter group
        if ($this->golongan) {
            if (Group::on('user')->where('group', $this->golongan)->first() != NULL) {
                // ubah menjadi view
                if($this->kategori) {
                    $product = $product->whereHas('description.group', function ($query)  {
                        $query->where('group', $this->golongan);
                    });
                }else{
                    $product = Produk::on('user')->whereHas('description.group', function ($query)  { 
                        $query->where('group', $this->golongan);
                    });
                }
            }else{
                $product = NULL;
            }
        }
        // akhir filter group

        // filter unit
        if ($this->bentuk) {
            if (Unit::on('user')->where('unit', $this->bentuk)->first() != NULL) {
                // ubah menjadi view
                if($this->golongan) {
                    $product = $product->whereHas('description.unit', function ($query)  {
                        $query->where('unit', $this->bentuk);
                    });
                }elseif($this->kategori){
                    $product = $product->whereHas('description.unit', function ($query)  {
                        $query->where('unit', $this->bentuk);
                    });
                }else{
                    $product = Produk::on('user')->whereHas('description.unit', function ($query)  { 
                        $query->where('unit', $this->bentuk);
                    });
                }
            }else{
                $product = NULL;
            }
        }
        // akhir filter unit

        // filter harga
        if ($this->maksimum || $this->minimum) {
            if ($this->maksimum) {
                if($this->golongan || $this->kategori || $this->bentuk) {
                    $product = $product->whereHas('detail', function($query)  {
                        $query->where('product_sell_price', '<=', $this->maksimum);
                    });
                }else{
                    $product = Produk::on('user')->whereHas('detail', function($query)  {
                        $query->where('product_sell_price', '<=', $this->maksimum);
                    });
                }
            }
            
            if ($this->minimum){
                if($this->golongan || $this->kategori || $this->bentuk || $this->maksimum) {
                    $product = $product->whereHas('detail', function($query)  {
                        $query->where('product_sell_price', '>=', $this->minimum);
                    });
                }else{
                    $product = Product::on('user')->whereHas('detail', function($query)  {
                        $query->where('product_sell_price', '>=', $this->minimum);
                    });
                }
            }
        }
        // akhir filter harga

        // filter
        if ($this->filter) {

            
            if ($this->filter == "Nama A - Z"){
                if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum) {
                    $product = $product->orderBy('product_name');
                }else{
                    $product = Produk::on('user')->orderBy('product_name');
                }
            }

            if ($this->filter == "Nama Z - A"){
                if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum) {
                    $product = $product->orderBy('product_name', 'DESC');
                }else{
                    $product = Produk::on('user')->orderBy('product_name', 'DESC');
                }
            }

            if ($this->filter == "Harga Tinggi - Rendah"){
                if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum) {
                    $product = $product->join('detail_produk', 'products.product_id', '=', 'detail_produk.product_id')
                    ->orderBy('detail_produk.product_sell_price', 'DESC')
                    ->select('products.*', 'detail_produk.product_sell_price')
                    ->distinct();
                }else{
                    $product = Produk::on('user')->join('detail_produk', 'products.product_id', '=', 'detail_produk.product_id')
                    ->orderBy('detail_produk.product_sell_price', 'DESC')
                    ->select('products.*', 'detail_produk.product_sell_price')
                    ->distinct();
                }
            }

            if ($this->filter == "Harga Rendah - Tinggi"){
                if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum) {
                    $product = $product->join('detail_produk', 'products.product_id', '=', 'detail_produk.product_id')
                    ->orderBy('detail_produk.product_sell_price', 'ASC')
                    ->select('products.*', 'detail_produk.product_sell_price')
                    ->distinct();
                }else{
                    $product = Produk::on('user')->join('detail_produk', 'produk.product_id', '=', 'detail_produk.product_id')
                    ->orderBy('detail_produk.product_sell_price', 'ASC')
                    ->select('products.*', 'detail_produk.product_sell_price')
                    ->distinct();
                }
            }
        }
        // akhir filter

        // filter cari
            if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum || $this->filter) {
                $product = $product->where('Produk.product_name', 'like' ,"%". $cari ."%");
            }else{
                $product = Produk::on('user')->where('Produk.product_name', 'like' ,"%". $cari ."%");
            }
        // akhir filter cari

        $this->products = $product->orderBy('product_status')->get();

        // dd($this->products);
    }
    
    public function counts($product) {
        $this->dispatch('count_cart', auth()->user()->user_id, $product['product_id'], 1);
    }

    public function render()
    {
        return view('livewire.liveshow-product');
    }
}
