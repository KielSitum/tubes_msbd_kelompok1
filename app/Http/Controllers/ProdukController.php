<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Kategori;
use App\Models\Group;
use App\Models\User;
use App\Models\Kasir;
use App\Models\InvoiceSelling;
use App\Models\InvoiceSellingDetail;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function home() {
        $products = Produk::where('product_status', 'aktif')->get(); // Mengambil produk biasa
        $products_random = Produk::where('product_status', 'aktif')->get()->random(4); // Mengambil produk biasa

        $product_last_purcase = [];
        
        if (Auth()->user()) {
            $products_last_purcase = InvoiceSelling::where('customer_id', Auth()->user()->user_id)
                ->orderBy('order_date', 'desc')
                ->get();
            
            if ($products_last_purcase->count() > 0) {
                foreach ($products_last_purcase as $product) {
                    foreach (optional($product->sellinginvoicedetail) as $p) {
                        $product_last_purcase[] = $p;
                    }
                }
                
                foreach (collect($product_last_purcase) as $p) {
                    $produk = Produk::where('product_name', $p->product_name)
                        ->where('product_status', 'aktif')
                        ->first();
                    if ($produk) {
                        $products[] = DB::table('product_view')->where('product_name', $p->product_name)->get();
                    }
                }
            }
        }
    
        return view("user.index", [
            "title" => "Toko Obat Subur Tigarunggu",
            "categories" => Kategori::orderBy('category')->get() ?? [],
            "products_last_purcase" => collect($products ?? [])->take(5),
            "products" => $products,
            "products_random" => $products_random,

        ]);
    }
    
    
    public function produk(Request $request) {
        // dd($request->all());
        $categories = Kategori::orderBy('category')->get();
        $groups = Group::orderBy('group')->get();
        $units = Unit::orderBy('unit')->get();

        $all_product = Produk::all();

        // filter kategori
        if ($request->kategori) {
            if (Kategori::where('category', $request->kategori)->first() != NULL) {
                // ubah menjadi view
                $product = Produk::whereHas('description.category', function ($query) use ($request) { 
                    $query->where('category', $request->kategori);
                });
            }else{
                $product = NULL;
            }
        }
        // akhir filter kategori

        // filter group
        if ($request->golongan) {
            if (Group::where('group', $request->golongan)->first() != NULL) {
                // ubah menjadi view
                if($request->kategori) {
                    $product = $product->whereHas('description.group', function ($query) use ($request) {
                        $query->where('group', $request->golongan);
                    });
                }else{
                    $product = Produk::whereHas('description.group', function ($query) use ($request) { 
                        $query->where('group', $request->golongan);
                    });
                }
            }else{
                $product = NULL;
            }
        }
        // akhir filter group

        // filter unit
        if ($request->bentuk) {
            if (Unit::where('unit', $request->bentuk)->first() != NULL) {
                // ubah menjadi view
                if($request->golongan) {
                    $product = $product->whereHas('description.unit', function ($query) use ($request) {
                        $query->where('unit', $request->bentuk);
                    });
                }elseif($request->kategori){
                    $product = $product->whereHas('description.unit', function ($query) use ($request) {
                        $query->where('unit', $request->bentuk);
                    });
                }else{
                    $product = Produk::whereHas('description.unit', function ($query) use ($request) { 
                        $query->where('unit', $request->bentuk);
                    });
                }
            }else{
                $product = NULL;
            }
        }
        // akhir filter unit

        // filter harga
        if ($request->maksimum || $request->minimum) {
            if ($request->maksimum) {
                if($request->golongan || $request->kategori || $request->bentuk) {
                        $product = $product->where('product_sell_price', '<=', $request->maksimum);
                    }else{
                        $product = Produk::where('product_sell_price', '<=', $request->maksimum);
                    };
                }
            
            if($request->minimum){
                if($request->golongan || $request->kategori || $request->bentuk || $request->maksimum) {
                    $product = $product->where('product_sell_price', '>=', $request->minimum);
                }else{
                    $product = Produk::where('product_sell_price', '>=', $request->minimum);
                }
            }
        }
        // akhir filter harga

        // filter
        if ($request->filter) {          
            if ($request->filter == "Nama A - Z"){
                if($request->golongan || $request->kategori || $request->bentuk || $request->minimum || $request->maksimum) {
                    $product = $product->orderBy('product_name');
                }else{
                    $product = Produk::orderBy('product_name');
                }
            }

            if ($request->filter == "Nama Z - A"){
                if($request->golongan || $request->kategori || $request->bentuk || $request->minimum || $request->maksimum) {
                    $product = $product->orderBy('product_name', 'DESC');
                }else{
                    $product = Produk::orderBy('product_name', 'DESC');
                }
            }

            if ($request->filter == "Harga Tinggi - Rendah"){
                if($request->golongan || $request->kategori || $request->bentuk || $request->minimum || $request->maksimum) {
                    $product = $product->orderBy('product_sell_price', 'DESC');
                }else{
                    $product = Produk::orderBy('product_sell_price', 'DESC');
                }
            }

            if ($request->filter == "Harga Rendah - Tinggi"){
                if($request->golongan || $request->kategori || $request->bentuk || $request->minimum || $request->maksimum) {
                    $product = $product->orderBy('product_sell_price', 'ASC');
                }else{
                    $product = Produk::orderBy('product_sell_price', 'ASC');
                }
            }
        }
        // akhir filter

        // filter cari
        if ($request->cari) {
                if($request->golongan || $request->kategori || $request->bentuk || $request->minimum || $request->maksimum || $request->filter) {
                    $product = $product->where('Produk.product_name', 'like' ,"%". $request->cari ."%");
                }else{
                    $product = Produk::where('Produk.product_name', 'like' ,"%". $request->cari ."%");
                }
        }
        // akhir filter cari
            
        if(isset($product)) {
            $product = $product->orderBy('product_status')->paginate(12)->withQueryString();
        }else{
            $product = Produk::orderBy('product_status')->paginate(12)->withQueryString();
        }

        return view("user.products", [
            "products"=> $product ?? NULL,
            "all_products" => $all_product ?? [],
            "categories"=> $categories ?? [],
            "units"=> $units ?? [],
            "groups"=> $groups ?? [],
        ]);
    }

    public function deskripsiProduk(Request $request){
        $products = DB::table('product_view')->get();
        
        foreach($products as $product){
            if(Str::slug($product->product_name) == $request->product){
                return view("user.description-product",[
                    "description_product" => $product ?? [],
                ]);
            }
        }

        abort(404);
    }

    public function produk_cashier()
    {
        $product = Produk::orderBy('product_status')->paginate(8);
        $categories = Kategori::orderBy('category')->get();
        $groups = Group::orderBy('group')->get();
        $units = Unit::orderBy('unit')->get();

        return view("kasir.index", [
            "products"=> $product ?? NULL,
            "categories"=> $categories ?? [],
            "units"=> $units ?? [],
            "groups"=> $groups ?? [],
        ]);
    }
    
}