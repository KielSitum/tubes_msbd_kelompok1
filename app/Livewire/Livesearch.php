<?php

namespace App\Livewire;

use App\Models\Produk;
use Livewire\Component;

class Livesearch extends Component
{
    protected $listeners = ["livesearch"];
    public $product;
    public $cari;

    public function livesearch($cari){
            $this->product = Produk::on('user')->where("product_name", "Like", "%". $cari ."%")->take(10)->get();
    }
    
    public function render()
    {
        
        return view('livewire.livesearch',[
            'products'=> $this->product ?? [],
        ]);
    }
}