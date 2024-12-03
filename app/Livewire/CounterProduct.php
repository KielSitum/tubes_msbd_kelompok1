<?php

namespace App\Livewire;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CounterProduct extends Component
{
    public $count = 1;
    public $stock_product;
    public $user_id;
    public $product_id;
    public $status;

    public function mount($stock, $user, $product, $status)
    {
        $this->stock_product = $stock;
        $this->user_id = $user;
        $this->product_id = $product;
        $this->status = $status;
    }

    public function decrement() {
        $this->count = $this->count - 1;
    }

    public function increment() {
        $this->count = $this->count + 1;
    }
    
    public function counts() {


        Keranjang::create([
            'cart_id' => md5($this->user_id . $this->product_id . uniqid()), // Tambahkan uniqid untuk memastikan keunikan
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'quantity' => $this->count,
        ]);
        
        
    
        session()->flash('message', 'Produk berhasil ditambahkan ke keranjang.');
    }
    

    public function render()
    {
        return view('livewire.counter-product');
    }
}
